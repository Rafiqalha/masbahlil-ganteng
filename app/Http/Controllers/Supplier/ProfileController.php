<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Supplier;

class ProfileController extends Controller
{
    public function edit(Request $request)
    {
        $supplier = auth()->user()->supplier()->with('documents')->first();

        return Inertia::render('Supplier/Profile', [
            'supplier' => $supplier,
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama_usaha' => 'required|string|max:255',
            'alamat' => 'required|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'kategori_produk' => 'required|string',
            'kapasitas_produksi_harian' => 'nullable|integer',
        ]);

        $supplier = auth()->user()->supplier;

        $supplier->update($request->only([
            'nama_usaha',
            'alamat',
            'latitude',
            'longitude',
            'kategori_produk',
            'kapasitas_produksi_harian',
        ]));

        return redirect()->route('supplier.profile.edit')->with('success', 'Profil berhasil diperbarui.');
    }
}
