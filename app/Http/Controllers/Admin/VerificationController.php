<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Supplier;
use App\Models\Sppg;

class VerificationController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::where('status_verifikasi', 'PENDING')->latest()->get();
        $sppgs = Sppg::where('status_verifikasi', 'PENDING')->latest()->get();

        return Inertia::render('Admin/Verification/Index', [
            'suppliers' => $suppliers,
            'sppgs' => $sppgs,
        ]);
    }

    public function show($type, $id)
    {
        if ($type === 'supplier') {
            $entity = Supplier::with('documents')->findOrFail($id);
        } else if ($type === 'sppg') {
            $entity = Sppg::findOrFail($id);
        } else {
            abort(404);
        }

        return Inertia::render('Admin/Verification/Show', [
            'type' => $type,
            'entity' => $entity,
        ]);
    }

    public function update(Request $request, $type, $id)
    {
        $request->validate([
            'status_verifikasi' => 'required|in:APPROVED,REJECTED',
            'catatan_verifikasi' => 'nullable|string',
        ]);

        if ($type === 'supplier') {
            $entity = Supplier::findOrFail($id);
        } else if ($type === 'sppg') {
            $entity = Sppg::findOrFail($id);
        } else {
            abort(404);
        }

        $entity->update([
            'status_verifikasi' => $request->status_verifikasi,
            'catatan_verifikasi' => $request->catatan_verifikasi,
            'verified_at' => now(),
            'verified_by' => auth()->id(),
        ]);

        return redirect()->route('admin.verification.index')->with('success', 'Status verifikasi berhasil diperbarui.');
    }
}
