<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Layanan\KkprController;
use Illuminate\Support\Facades\Route;

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

require __DIR__.'/auth.php';
