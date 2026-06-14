<?php

namespace App\Http\Controllers\Sppg;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProcurementRequest;
use App\Services\MatchingService;

class MatchingController extends Controller
{
    protected $matchingService;

    public function __construct(MatchingService $matchingService)
    {
        $this->matchingService = $matchingService;
    }

    public function store(Request $request, ProcurementRequest $procurement)
    {
        // Pastikan SPPG yang login adalah pemilik procurement ini
        if ($procurement->sppg_id !== auth()->user()->sppg->id) {
            abort(403);
        }

        try {
            $this->matchingService->runMatching($procurement);
            return redirect()->route('sppg.procurement.show', $procurement->id)->with('success', 'Algoritma SAW berhasil dijalankan. Berikut adalah rekomendasi supplier untuk Anda.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menjalankan algoritma: ' . $e->getMessage());
        }
    }
}
