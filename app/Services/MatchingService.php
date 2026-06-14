<?php

namespace App\Services;

use App\Models\ProcurementRequest;
use App\Models\Supplier;
use App\Models\MatchingResult;
use App\Models\Partnership;
use App\Models\SupplierDocument;
use Illuminate\Support\Facades\DB;

class MatchingService
{
    // Bobot Kriteria
    const WEIGHT_DISTANCE = 0.40;
    const WEIGHT_CAPACITY = 0.30;
    const WEIGHT_DOCUMENT = 0.20;
    const WEIGHT_HISTORY  = 0.10;

    public function runMatching(ProcurementRequest $procurement)
    {
        $sppg = $procurement->sppg;
        if (!$sppg->latitude || !$sppg->longitude) {
            throw new \Exception("Lokasi SPPG belum diatur. Lengkapi profil terlebih dahulu.");
        }

        // 1. Filter Kandidat Supplier
        $candidates = Supplier::where('status_verifikasi', 'APPROVED')
            ->where('kategori_produk', $procurement->kategori_produk)
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get();

        if ($candidates->isEmpty()) {
            return [];
        }

        $filteredCandidates = [];
        $maxDistance = 0;
        $maxCapacity = 0;

        // 2. Hitung Jarak dan Evaluasi Kandidat
        foreach ($candidates as $supplier) {
            $distance = $this->calculateDistance(
                $sppg->latitude,
                $sppg->longitude,
                $supplier->latitude,
                $supplier->longitude
            );

            // Filter Radius (jika melebihi batas radius, lewati)
            if ($distance > $procurement->radius_km) {
                continue;
            }

            // Hitung skor dokumen (berdasarkan dokumen yang APPROVED)
            $approvedDocsCount = SupplierDocument::where('supplier_id', $supplier->id)
                ->where('verification_status', 'APPROVED') // sesuai dengan yg kita perbaiki
                ->count();
            
            $docScore = 0.5; // Default NIB
            if ($approvedDocsCount == 2) $docScore = 0.75;
            if ($approvedDocsCount >= 3) $docScore = 1.0;

            // Hitung skor history (berdasarkan partnership yang ACTIVE/COMPLETED)
            $historyCount = Partnership::where('supplier_id', $supplier->id)
                ->whereIn('status', ['ACTIVE', 'COMPLETED'])
                ->count();
            $historyScore = min($historyCount / 10, 1.0);

            $filteredCandidates[] = [
                'supplier' => $supplier,
                'distance' => $distance,
                'capacity' => (float) $supplier->kapasitas_harian, // Mengambil properti yang benar
                'doc_score' => $docScore,
                'history_score' => $historyScore,
            ];

            if ($distance > $maxDistance) $maxDistance = $distance;
            if ($supplier->kapasitas_harian > $maxCapacity) $maxCapacity = $supplier->kapasitas_harian;
        }

        // Hindari pembagian dengan nol
        if ($maxDistance == 0) $maxDistance = 1;
        if ($maxCapacity == 0) $maxCapacity = 1;

        // 3. Normalisasi dan Pembobotan SAW
        $results = [];
        foreach ($filteredCandidates as $c) {
            // Jarak: Semakin dekat semakin baik (Cost Criteria)
            // Normalisasi Cost = Min(distance) / distance, tapi dalam algoritma ini PRD meminta: 1 - (d/dmax)
            $normDistance = 1 - ($c['distance'] / $maxDistance);

            // Kapasitas: Semakin besar semakin baik (Benefit Criteria)
            $normCapacity = $c['capacity'] / $maxCapacity;

            // Total Skor SAW
            $totalScore = (self::WEIGHT_DISTANCE * $normDistance) +
                          (self::WEIGHT_CAPACITY * $normCapacity) +
                          (self::WEIGHT_DOCUMENT * $c['doc_score']) +
                          (self::WEIGHT_HISTORY * $c['history_score']);

            $results[] = [
                'supplier_id' => $c['supplier']->id,
                'distance_km' => $c['distance'],
                'distance_score' => $normDistance,
                'capacity_score' => $normCapacity,
                'document_score' => $c['doc_score'],
                'history_score' => $c['history_score'],
                'total_score' => $totalScore,
            ];
        }

        // 4. Ranking (Sortir berdasarkan skor tertinggi)
        usort($results, function($a, $b) {
            return $b['total_score'] <=> $a['total_score']; // Descending
        });

        // 5. Simpan ke Database
        DB::beginTransaction();
        try {
            // Hapus hasil sebelumnya untuk procurement ini
            MatchingResult::where('procurement_request_id', $procurement->id)->delete();

            $rank = 1;
            foreach ($results as $res) {
                MatchingResult::create([
                    'procurement_request_id' => $procurement->id,
                    'supplier_id' => $res['supplier_id'],
                    'distance_km' => $res['distance_km'],
                    'distance_score' => $res['distance_score'],
                    'capacity_score' => $res['capacity_score'],
                    'document_score' => $res['document_score'],
                    'history_score' => $res['history_score'],
                    'total_score' => $res['total_score'],
                    'ranking' => $rank++,
                ]);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return $results;
    }

    /**
     * Hitung jarak dua koordinat dengan formula Haversine (Output dalam KM)
     */
    private function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371; // Jari-jari bumi rata-rata dalam km

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
             sin($dLon / 2) * sin($dLon / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;
    }
}
