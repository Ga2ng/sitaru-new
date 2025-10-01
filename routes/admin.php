<?php

use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminKontakController;
use App\Http\Controllers\Admin\AdminSliderController;
use App\Http\Controllers\Admin\AdminBeritaController;
use App\Http\Controllers\Admin\AdminInformasiController;
use App\Http\Controllers\Admin\AdminSettingsController;
use App\Http\Controllers\Admin\AdminKkprController;
use App\Http\Controllers\Admin\AdminKkprNonController;
use App\Http\Controllers\Admin\AdminPengaduanController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

Route::prefix('admin')->name('admin.')->middleware(['auth', 'permission:User'])->group(function () {
    // User Management Routes
    Route::resource('users', AdminUserController::class);
    Route::post('users/{user}/toggle-status', [AdminUserController::class, 'toggleStatus'])->name('users.toggle-status');
    Route::get('users/{user}/reset-password', [AdminUserController::class, 'resetPassword'])->name('users.reset-password');
    Route::patch('users/{user}/update-password', [AdminUserController::class, 'updatePassword'])->name('users.update-password');

    // Kontak Management Routes
    Route::resource('kontak', AdminKontakController::class)->only(['index', 'show', 'destroy']);

    // Slider Management Routes
    Route::resource('slider', AdminSliderController::class);
    Route::post('slider/{slider}/toggle-status', [AdminSliderController::class, 'toggleStatus'])->name('slider.toggle-status');

    // Berita Management Routes
    Route::resource('berita', AdminBeritaController::class);
    Route::post('berita/{berita}/toggle-status', [AdminBeritaController::class, 'toggleStatus'])->name('berita.toggle-status');

    // Informasi Management Routes
    Route::resource('informasi', AdminInformasiController::class);
    Route::post('informasi/{informasi}/toggle-status', [AdminInformasiController::class, 'toggleStatus'])->name('informasi.toggle-status');

            // Settings Management Routes
            Route::get('settings', [AdminSettingsController::class, 'index'])->name('settings.index')->middleware('permission:Setting');
            Route::put('settings', [AdminSettingsController::class, 'update'])->name('settings.update')->middleware('permission:Setting');

            // KKPR Management Routes
            Route::resource('kkpr', AdminKkprController::class);
            Route::post('kkpr/{kkpr}/toggle-status', [AdminKkprController::class, 'toggleStatus'])->name('kkpr.toggle-status');
            Route::get('kkpr/{kkpr}/riwayat', [AdminKkprController::class, 'riwayat'])->name('kkpr.riwayat');
            Route::get('kkpr/{kkpr}/koordinat', [AdminKkprController::class, 'koordinat'])->name('kkpr.koordinat');
            Route::get('kkpr/{kkpr}/peta', [AdminKkprController::class, 'peta'])->name('kkpr.peta');
            Route::get('kkpr/{kkpr}/validasi', [AdminKkprController::class, 'validasi'])->name('kkpr.validasi');
            Route::post('kkpr/validasi', [AdminKkprController::class, 'validasiStore'])->name('kkpr.validasi.store');
            Route::post('kkpr/revisi', [AdminKkprController::class, 'validasiRevisi'])->name('kkpr.revisi');

            // KKPR Non Berusaha Management Routes
            Route::resource('kkprnon', AdminKkprNonController::class);
            Route::get('kkprnon/{kkprnon}/riwayat', [AdminKkprNonController::class, 'riwayat'])->name('kkprnon.riwayat');
            Route::get('kkprnon/{kkprnon}/koordinat', [AdminKkprNonController::class, 'koordinat'])->name('kkprnon.koordinat');
            Route::get('kkprnon/{kkprnon}/peta', [AdminKkprNonController::class, 'peta'])->name('kkprnon.peta');
            Route::get('kkprnon/{kkprnon}/validasi', [AdminKkprNonController::class, 'validasi'])->name('kkprnon.validasi');
            Route::post('kkprnon/validasi', [AdminKkprNonController::class, 'validasiStore'])->name('kkprnon.validasi.store');
            Route::post('kkprnon/revisi', [AdminKkprNonController::class, 'validasiRevisi'])->name('kkprnon.revisi');
            Route::post('kkprnon/upload-draft', [AdminKkprNonController::class, 'uploadDraft'])->name('kkprnon.upload.draft');

            // Pengaduan Management Routes
            Route::resource('pengaduan', AdminPengaduanController::class);
            Route::get('pengaduan/{pengaduan}/riwayat', [AdminPengaduanController::class, 'riwayat'])->name('pengaduan.riwayat');
            Route::post('pengaduan/tolak', [AdminPengaduanController::class, 'tolakPengaduan'])->name('pengaduan.tolak');
            Route::post('pengaduan/penanganan', [AdminPengaduanController::class, 'penangananPengaduan'])->name('pengaduan.penanganan');
            Route::post('pengaduan/proses', [AdminPengaduanController::class, 'pengaduanProses'])->name('pengaduan.proses');

    // API Routes for roles and permissions
    Route::get('roles', function() {
        return Role::select('id', 'name')->get();
    })->name('roles');

    Route::get('permissions', function() {
        return Permission::select('id', 'name')->get();
    })->name('permissions');
});
