<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Partnership;
use App\Notifications\PartnershipAccepted;
use App\Notifications\PartnershipRejected;

class PartnershipRequestController extends Controller
{
    public function index()
    {
        $supplier = auth()->user()->supplier;
        $partnerships = Partnership::where('supplier_id', $supplier->id)
            ->with(['procurementRequest.sppg'])
            ->latest()
            ->get();

        return Inertia::render('Supplier/Partnerships/Index', [
            'partnerships' => $partnerships,
        ]);
    }

    public function update(Request $request, Partnership $partnership)
    {
        $request->validate([
            'status' => 'required|in:ACTIVE,REJECTED',
            'catatan_penolakan' => 'nullable|string|required_if:status,REJECTED',
        ]);

        if ($partnership->supplier_id !== auth()->user()->supplier->id) {
            abort(403);
        }

        if ($partnership->status !== 'PENDING') {
            return redirect()->back()->with('error', 'Permintaan ini sudah direspons.');
        }

        $partnership->update([
            'status' => $request->status,
            'catatan_penolakan' => $request->catatan_penolakan,
            'responded_at' => now(),
        ]);

        // Kirim Notifikasi ke SPPG
        if ($request->status === 'ACTIVE') {
            $partnership->procurementRequest->sppg->user->notify(new PartnershipAccepted($partnership));
            $msg = 'Permintaan kerja sama berhasil diterima!';
        } else {
            $partnership->procurementRequest->sppg->user->notify(new PartnershipRejected($partnership));
            $msg = 'Permintaan kerja sama ditolak.';
        }

        return redirect()->route('supplier.partnerships.index')->with('success', $msg);
    }
}
