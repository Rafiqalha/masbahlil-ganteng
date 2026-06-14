<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    $user = auth()->user();
    if ($user->hasRole('admin')) {
        return redirect()->route('admin.dashboard');
    } elseif ($user->hasRole('sppg')) {
        return redirect()->route('sppg.dashboard');
    } elseif ($user->hasRole('supplier')) {
        return redirect()->route('supplier.dashboard');
    }
    return Inertia::render('Dashboard'); // Fallback
})->middleware(['auth', 'verified'])->name('dashboard');

// Supplier Routes
Route::middleware(['auth', 'role:supplier'])->prefix('supplier')->name('supplier.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Supplier\DashboardController::class, 'index'])->name('dashboard');
    
    // Profile
    Route::get('/profile', [\App\Http\Controllers\Supplier\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [\App\Http\Controllers\Supplier\ProfileController::class, 'update'])->name('profile.update');
    
    // Documents
    Route::post('/documents', [\App\Http\Controllers\Supplier\DocumentController::class, 'store'])->name('documents.store');
    Route::delete('/documents/{document}', [\App\Http\Controllers\Supplier\DocumentController::class, 'destroy'])->name('documents.destroy');
    // Partnerships (Supplier)
    Route::get('/partnerships', [\App\Http\Controllers\Supplier\PartnershipRequestController::class, 'index'])->name('partnerships.index');
    Route::put('/partnerships/{partnership}', [\App\Http\Controllers\Supplier\PartnershipRequestController::class, 'update'])->name('partnerships.update');
});

// SPPG Routes
Route::middleware(['auth', 'verified', 'role:sppg'])->prefix('sppg')->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Sppg/Dashboard', [
            'sppg' => auth()->user()->sppg,
        ]);
    })->name('sppg.dashboard');

    Route::get('/profile/edit', [\App\Http\Controllers\Sppg\ProfileController::class, 'edit'])->name('sppg.profile.edit');
    Route::post('/profile', [\App\Http\Controllers\Sppg\ProfileController::class, 'update'])->name('sppg.profile.update');

    Route::get('/procurement', [\App\Http\Controllers\Sppg\ProcurementController::class, 'index'])->name('sppg.procurement.index');
    Route::get('/procurement/create', [\App\Http\Controllers\Sppg\ProcurementController::class, 'create'])->name('sppg.procurement.create');
    Route::post('/procurement', [\App\Http\Controllers\Sppg\ProcurementController::class, 'store'])->name('sppg.procurement.store');
    Route::get('/procurement/{procurement}', [\App\Http\Controllers\Sppg\ProcurementController::class, 'show'])->name('sppg.procurement.show');
    Route::post('/procurement/{procurement}/match', [\App\Http\Controllers\Sppg\MatchingController::class, 'store'])->name('sppg.procurement.match');

    // Partnerships (SPPG)
    Route::get('/partnerships', [\App\Http\Controllers\Sppg\PartnershipController::class, 'index'])->name('sppg.partnerships.index');
    Route::post('/partnerships', [\App\Http\Controllers\Sppg\PartnershipController::class, 'store'])->name('sppg.partnerships.store');
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    
    // Verifikasi
    Route::get('/verification', [\App\Http\Controllers\Admin\VerificationController::class, 'index'])->name('verification.index');
    Route::get('/verification/{type}/{id}', [\App\Http\Controllers\Admin\VerificationController::class, 'show'])->name('verification.show');
    Route::post('/verification/{type}/{id}', [\App\Http\Controllers\Admin\VerificationController::class, 'update'])->name('verification.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
