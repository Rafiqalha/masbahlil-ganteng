<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SupplierDocument;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama_dokumen' => 'required|string|max:255',
            'file_path' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $supplier = auth()->user()->supplier;

        $path = $request->file('file_path')->store('supplier_documents', 'public');

        SupplierDocument::create([
            'supplier_id' => $supplier->id,
            'document_name' => $request->nama_dokumen,
            'document_type' => 'LAINNYA',
            'file_path' => $path,
            'file_size_bytes' => $request->file('file_path')->getSize(),
            'mime_type' => $request->file('file_path')->getMimeType(),
            'verification_status' => 'PENDING',
        ]);

        return redirect()->back()->with('success', 'Dokumen berhasil diunggah.');
    }

    public function destroy(SupplierDocument $document)
    {
        // Ensure the document belongs to the authenticated user's supplier
        if ($document->supplier_id !== auth()->user()->supplier->id) {
            abort(403);
        }

        Storage::disk('public')->delete($document->file_path);
        $document->delete();

        return redirect()->back()->with('success', 'Dokumen berhasil dihapus.');
    }
}
