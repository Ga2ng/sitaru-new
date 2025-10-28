<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Layanan\KkprController;
use App\Http\Controllers\PetaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

Route::get('/', [App\Http\Controllers\WelcomeController::class, 'index']);

// Cek Status KKPR (Public - No Middleware)
Route::prefix('cek-status')->name('cek-status.')->group(function () {
    Route::get('/', [App\Http\Controllers\CekStatusController::class, 'index'])->name('index');
    Route::post('/search', [App\Http\Controllers\CekStatusController::class, 'search'])->name('search');
    Route::get('/{id}', [App\Http\Controllers\CekStatusController::class, 'show'])->name('show');
});

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// Peta Route
Route::get('/peta', [PetaController::class, 'index'])->name('peta.index');

// API Peta (public) - gabungan geojson KKPR & UMK
Route::get('/api/map/combined-geojson', [\App\Http\Controllers\Api\MapController::class, 'combined'])->name('api.map.combined');

// API Peta - Summary dan Refresh Data Map
Route::post('/api/map/refresh-data', [\App\Http\Controllers\Api\MapController::class, 'refreshDataMap'])->name('api.map.refresh');
Route::get('/api/map/summary-kkpr', [\App\Http\Controllers\Api\MapController::class, 'summaryKkpr'])->name('api.map.summary.kkpr');
Route::get('/api/map/summary-umk', [\App\Http\Controllers\Api\MapController::class, 'summaryUmk'])->name('api.map.summary.umk');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Layanan Routes
    Route::prefix('layanan')->name('layanan.')->group(function () {
        Route::get('/kkpr', [KkprController::class, 'index'])->name('kkpr.index');
    });
});



// Route::get('/debug-login', function () {
//     $credentials = [
//         'email' => 'jimbon@sitaru.test',
//         'password' => 'jimbon123',
//     ];

//     if (Auth::attempt($credentials)) {
//         return '✅ Login berhasil';
//     } else {
//         return '❌ Login gagal';
//     }
// });

Route::get('/clear-rate-limit', function () {
    $key = Str::transliterate(Str::lower('jimbon@sitaru.test').'|127.0.0.1');
    RateLimiter::clear($key);
    
    return 'Rate limit cleared for jimbon@sitaru.test';
});
require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/member.php';
