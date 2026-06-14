<?php

namespace App\Http\Controllers\Sppg;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $sppg = auth()->user()->sppg;
        $procurements = $sppg->procurementRequests()->latest()->take(5)->get();
        
        return Inertia::render('Sppg/Dashboard', [
            'sppg' => $sppg,
            'procurements' => $procurements,
        ]);
    }
}
