<?php

namespace App\Http\Controllers\Sppg;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\ProcurementRequest;

class ProcurementController extends Controller
{
    public function index()
    {
        $sppg = auth()->user()->sppg;
        $procurements = $sppg->procurementRequests()->latest()->get();

        return Inertia::render('Sppg/Procurement/Index', [
            'procurements' => $procurements,
        ]);
    }

    public function create()
    {
        return Inertia::render('Sppg/Procurement/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_kebutuhan' => 'required|string',
            'kuantitas_porsi' => 'required|integer|min:1',
            'harga_maksimal_per_porsi' => 'required|numeric|min:0',
            'radius_maksimal_km' => 'required|numeric|min:0|max:9999',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'deskripsi_kebutuhan' => 'nullable|string',
        ]);

        $sppg = auth()->user()->sppg;

        ProcurementRequest::create([
            'sppg_id' => $sppg->id,
            'kategori_produk' => $request->kategori_kebutuhan,
            'jumlah_kebutuhan' => $request->kuantitas_porsi,
            'satuan' => 'Porsi',
            'harga_maksimal' => $request->harga_maksimal_per_porsi,
            'radius_km' => $request->radius_maksimal_km,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'deskripsi_kebutuhan' => $request->deskripsi_kebutuhan,
            'status' => 'OPEN',
        ]);

        return redirect()->route('sppg.procurement.index')->with('success', 'Permintaan pengadaan (Procurement) berhasil dibuat.');
    }

    public function show(ProcurementRequest $procurement)
    {
        if ($procurement->sppg_id !== auth()->user()->sppg->id) {
            abort(403);
        }

        $procurement->load(['matchingResults.supplier', 'sppg']);

        return Inertia::render('Sppg/Procurement/Show', [
            'procurement' => $procurement,
        ]);
    }
}
