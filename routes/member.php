<?php

use App\Http\Controllers\Member\MemberKkprController;
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
    });
});
