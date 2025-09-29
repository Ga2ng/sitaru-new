<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Layanan\KkprController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

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
