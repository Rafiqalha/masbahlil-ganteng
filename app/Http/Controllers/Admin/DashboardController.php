<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Supplier;
use App\Models\Sppg;
use App\Models\ProcurementRequest;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_suppliers' => Supplier::count(),
            'total_sppgs' => Sppg::count(),
            'total_procurements' => ProcurementRequest::count(),
            'pending_verifications' => Supplier::where('status_verifikasi', 'PENDING')->count() + Sppg::where('status_verifikasi', 'PENDING')->count(),
        ];

        $recent_verifications = [
            'suppliers' => Supplier::where('status_verifikasi', 'PENDING')->latest()->take(5)->get(),
            'sppgs' => Sppg::where('status_verifikasi', 'PENDING')->latest()->take(5)->get(),
        ];

        return Inertia::render('Admin/Dashboard', [
            'stats' => $stats,
            'recent_verifications' => $recent_verifications,
        ]);
    }
}
