<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $supplier = auth()->user()->supplier()->with('documents')->first();
        
        return Inertia::render('Supplier/Dashboard', [
            'supplier' => $supplier
        ]);
    }
}
