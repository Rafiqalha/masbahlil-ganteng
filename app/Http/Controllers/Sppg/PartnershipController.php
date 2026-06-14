<?php

namespace App\Http\Controllers\Sppg;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\ProcurementRequest;
use App\Models\Partnership;
use App\Models\Supplier;
use App\Notifications\PartnershipRequested;

class PartnershipController extends Controller
{
    public function index()
    {
        $sppg = auth()->user()->sppg;
        $partnerships = Partnership::whereHas('procurementRequest', function($q) use ($sppg) {
            $q->where('sppg_id', $sppg->id);
        })->with(['procurementRequest', 'supplier'])->latest()->get();

        return Inertia::render('Sppg/Partnerships/Index', [
            'partnerships' => $partnerships,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'procurement_request_id' => 'required|exists:procurement_requests,id',
            'supplier_id' => 'required|exists:suppliers,id',
        ]);

        $procurement = ProcurementRequest::findOrFail($request->procurement_request_id);
        
        // Pastikan milik SPPG ini
        if ($procurement->sppg_id !== auth()->user()->sppg->id) {
            abort(403);
        }

        // Pastikan supplier ada dan APPROVED
        $supplier = Supplier::findOrFail($request->supplier_id);
        if ($supplier->status_verifikasi !== 'APPROVED') {
            return redirect()->back()->with('error', 'Supplier tidak valid.');
        }

        // Cek duplikasi request
        $exists = Partnership::where('procurement_request_id', $procurement->id)
            ->where('supplier_id', $supplier->id)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'Anda sudah mengirimkan permintaan kerja sama ke supplier ini untuk kebutuhan tersebut.');
        }

        $partnership = Partnership::create([
            'procurement_request_id' => $procurement->id,
            'supplier_id' => $supplier->id,
            'status' => 'PENDING',
        ]);

        // Kirim Notifikasi ke User Supplier
        $supplier->user->notify(new PartnershipRequested($partnership));

        return redirect()->route('sppg.partnerships.index')->with('success', 'Permintaan kerja sama berhasil dikirim!');
    }
}
