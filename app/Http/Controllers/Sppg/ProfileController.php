<?php

namespace App\Http\Controllers\Sppg;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Sppg;

class ProfileController extends Controller
{
    public function edit(Request $request)
    {
        $sppg = auth()->user()->sppg;

        return Inertia::render('Sppg/Profile', [
            'sppg' => $sppg,
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama_sppg' => 'required|string|max:255',
            'alamat' => 'required|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'penanggung_jawab' => 'required|string|max:255',
            'nomor_telepon' => 'required|string|max:20',
        ]);

        $sppg = auth()->user()->sppg;

        $sppg->update($request->only([
            'nama_sppg',
            'alamat',
            'latitude',
            'longitude',
            'penanggung_jawab',
            'nomor_telepon',
        ]));

        return redirect()->route('sppg.profile.edit')->with('success', 'Profil SPPG berhasil diperbarui.');
    }
}
