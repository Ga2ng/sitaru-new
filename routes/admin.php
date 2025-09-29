<?php

use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminKontakController;
use App\Http\Controllers\Admin\AdminSliderController;
use App\Http\Controllers\Admin\AdminBeritaController;
use App\Http\Controllers\Admin\AdminInformasiController;
use App\Http\Controllers\Admin\AdminSettingsController;
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

    // API Routes for roles and permissions
    Route::get('roles', function() {
        return Role::select('id', 'name')->get();
    })->name('roles');

    Route::get('permissions', function() {
        return Permission::select('id', 'name')->get();
    })->name('permissions');
});
