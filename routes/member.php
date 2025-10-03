<?php

use App\Http\Controllers\Member\MemberKkprController;
use App\Http\Controllers\Member\MemberKkprNonController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    // Member KKPR Routes
    Route::prefix('member')->name('member.')->group(function () {
        Route::get('/kkpr', [MemberKkprController::class, 'index'])->name('kkpr.index');
        Route::get('/kkpr/create', [MemberKkprController::class, 'create'])->name('kkpr.create');
        Route::post('/kkpr', [MemberKkprController::class, 'store'])->name('kkpr.store');
        Route::get('/kkpr/{id}', [MemberKkprController::class, 'show'])->name('kkpr.show');
        Route::get('/kkpr/{id}/edit', [MemberKkprController::class, 'edit'])->name('kkpr.edit');
        Route::put('/kkpr/{id}', [MemberKkprController::class, 'update'])->name('kkpr.update');
        Route::delete('/kkpr/{id}', [MemberKkprController::class, 'destroy'])->name('kkpr.destroy');
        
        // PDF Routes
        Route::get('/kkpr/{id}/cetak', [MemberKkprController::class, 'cetakDetail'])->name('kkpr.cetak.detail');
        Route::get('/kkpr/cetak/daftar', [MemberKkprController::class, 'cetakDaftar'])->name('kkpr.cetak.daftar');
        
        // Member KKPR Non Routes
        Route::get('/kkprnon', [MemberKkprNonController::class, 'index'])->name('kkprnon.index');
        Route::get('/kkprnon/create', [MemberKkprNonController::class, 'create'])->name('kkprnon.create');
        Route::post('/kkprnon', [MemberKkprNonController::class, 'store'])->name('kkprnon.store');
        Route::get('/kkprnon/{id}', [MemberKkprNonController::class, 'show'])->name('kkprnon.show');
        Route::get('/kkprnon/{id}/edit', [MemberKkprNonController::class, 'edit'])->name('kkprnon.edit');
        Route::put('/kkprnon/{id}', [MemberKkprNonController::class, 'update'])->name('kkprnon.update');
        Route::delete('/kkprnon/{id}', [MemberKkprNonController::class, 'destroy'])->name('kkprnon.destroy');
        
        // PDF Routes for KKPR Non
        Route::get('/kkprnon/{id}/cetak', [MemberKkprNonController::class, 'cetakDetail'])->name('kkprnon.cetak.detail');
        Route::get('/kkprnon/cetak/daftar', [MemberKkprNonController::class, 'cetakDaftar'])->name('kkprnon.cetak.daftar');
    });
});
