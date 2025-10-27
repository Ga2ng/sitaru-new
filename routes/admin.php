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
use App\Http\Controllers\Admin\AdminPetaController;
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
            Route::get('kkpr/riwayat-data/{id}', [AdminKkprController::class, 'getRiwayatData'])->name('kkpr.riwayat.data');
            Route::get('kkpr/{kkpr}/koordinat', [AdminKkprController::class, 'koordinat'])->name('kkpr.koordinat');
            Route::get('kkpr/{kkpr}/peta', [AdminKkprController::class, 'peta'])->name('kkpr.peta');
            Route::get('kkpr/{kkpr}/validasi', [AdminKkprController::class, 'validasi'])->name('kkpr.validasi');
            Route::post('kkpr/validasi', [AdminKkprController::class, 'validasiStore'])->name('kkpr.validasi.store');
            Route::post('kkpr/revisi', [AdminKkprController::class, 'validasiRevisi'])->name('kkpr.revisi');
            Route::get('kkpr/{kkpr}/analisa', [AdminKkprController::class, 'analisa'])->name('kkpr.analisa');
            Route::post('kkpr/analisa/store', [AdminKkprController::class, 'analisaStore'])->name('kkpr.analisa.store');
            Route::get('kkpr/{kkpr}/edit-analisa', [AdminKkprController::class, 'editAnalisa'])->name('kkpr.edit.analisa');
            Route::put('kkpr/{kkpr}/update-analisa', [AdminKkprController::class, 'updateAnalisa'])->name('kkpr.update.analisa');
            Route::post('kkpr/tolak-dokumen', [AdminKkprController::class, 'tolakDokumen'])->name('kkpr.tolak.dokumen');
            Route::post('kkpr/hapus-dokumen', [AdminKkprController::class, 'hapusDokumen'])->name('kkpr.hapus.dokumen');
            Route::post('kkpr/survey/{id}', [AdminKkprController::class, 'survey'])->name('kkpr.survey');
            Route::post('kkpr/kirim-kabid/{id}', [AdminKkprController::class, 'kirimKabid'])->name('kkpr.kirim.kabid');
            Route::get('kkpr/{id}/persetujuan-dokumen', [AdminKkprController::class, 'persetujuanDokumen'])->name('kkpr.persetujuan');
            Route::post('kkpr/persetujuan/revisi', [AdminKkprController::class, 'persetujuanRevisi'])->name('kkpr.persetujuan.revisi');
            Route::post('kkpr/persetujuan/setuju', [AdminKkprController::class, 'persetujuanSetuju'])->name('kkpr.persetujuan.setuju');
            Route::post('kkpr/upload-draft', [AdminKkprController::class, 'uploadDraft'])->name('kkpr.upload.draft');
            Route::get('kkpr/{kkpr}/view-draft', [AdminKkprController::class, 'viewDraft'])->name('kkpr.view.draft');
            Route::get('kkpr/{kkpr}/cetak-berkas', [AdminKkprController::class, 'cetakBerkasKkpr'])->name('kkpr.cetak.berkas');
            Route::post('kkpr/tugaskan-tim-fpr/{id}', [AdminKkprController::class, 'tugaskanTimFpr'])->name('kkpr.tugaskan.tim.fpr');
            Route::post('kkpr/{id}/confirm-pencabutan', [AdminKkprController::class, 'confirmPencabutan'])->name('kkpr.confirm.pencabutan');

            // KKPR Non Berusaha Management Routes
            Route::resource('kkprnon', AdminKkprNonController::class);
            Route::get('kkprnon/{kkprnon}/riwayat', [AdminKkprNonController::class, 'riwayat'])->name('kkprnon.riwayat');
            Route::get('kkprnon/riwayat-data/{id}', [AdminKkprNonController::class, 'getRiwayatData'])->name('kkprnon.riwayat.data');
            Route::get('kkprnon/{kkprnon}/koordinat', [AdminKkprNonController::class, 'koordinat'])->name('kkprnon.koordinat');
            Route::get('kkprnon/{kkprnon}/peta', [AdminKkprNonController::class, 'peta'])->name('kkprnon.peta');
            Route::get('kkprnon/{kkprnon}/validasi', [AdminKkprNonController::class, 'validasi'])->name('kkprnon.validasi');
            Route::post('kkprnon/validasi', [AdminKkprNonController::class, 'validasiStore'])->name('kkprnon.validasi.store');
            Route::post('kkprnon/revisi', [AdminKkprNonController::class, 'validasiRevisi'])->name('kkprnon.revisi');
            Route::get('kkprnon/{kkprnon}/analisa', [AdminKkprNonController::class, 'analisa'])->name('kkprnon.analisa');
            Route::post('kkprnon/analisa/store', [AdminKkprNonController::class, 'analisaStore'])->name('kkprnon.analisa.store');
            Route::get('kkprnon/{kkprnon}/edit-analisa', [AdminKkprNonController::class, 'editAnalisa'])->name('kkprnon.edit.analisa');
            Route::put('kkprnon/{kkprnon}/update-analisa', [AdminKkprNonController::class, 'updateAnalisa'])->name('kkprnon.update.analisa');
            Route::post('kkprnon/tolak-dokumen', [AdminKkprNonController::class, 'tolakDokumen'])->name('kkprnon.tolak.dokumen');
            Route::post('kkprnon/hapus-dokumen', [AdminKkprNonController::class, 'hapusDokumenAnalisa'])->name('kkprnon.hapus.dokumen');
            Route::post('kkprnon/survey/{id}', [AdminKkprNonController::class, 'survey'])->name('kkprnon.survey');
            Route::post('kkprnon/kirim-kabid/{id}', [AdminKkprNonController::class, 'kirimKabid'])->name('kkprnon.kirim.kabid');
            Route::get('kkprnon/{id}/persetujuan-dokumen', [AdminKkprNonController::class, 'persetujuanDokumen'])->name('kkprnon.persetujuan');
            Route::post('kkprnon/persetujuan/revisi', [AdminKkprNonController::class, 'persetujuanRevisi'])->name('kkprnon.persetujuan.revisi');
            Route::post('kkprnon/persetujuan/setuju', [AdminKkprNonController::class, 'persetujuanSetuju'])->name('kkprnon.persetujuan.setuju');
            Route::post('kkprnon/upload-draft', [AdminKkprNonController::class, 'uploadDraft'])->name('kkprnon.upload.draft');
            Route::get('kkprnon/{kkprnon}/view-draft', [AdminKkprNonController::class, 'viewDraft'])->name('kkprnon.view.draft');
            Route::delete('kkprnon/{id}/delete-file/{fieldName}', [AdminKkprNonController::class, 'deleteFile'])->name('kkprnon.delete.file');
            Route::get('kkprnon/{kkprnon}/cetak-berkas', [AdminKkprNonController::class, 'cetakBerkasUmk'])->name('kkprnon.cetak.berkas');
            Route::post('kkprnon/{id}/confirm-pencabutan', [AdminKkprNonController::class, 'confirmPencabutan'])->name('kkprnon.confirm.pencabutan');

    // Pengaduan Management Routes
    Route::resource('pengaduan', AdminPengaduanController::class);
    Route::get('pengaduan/{pengaduan}/riwayat', [AdminPengaduanController::class, 'riwayat'])->name('pengaduan.riwayat');
    Route::post('pengaduan/tolak', [AdminPengaduanController::class, 'tolakPengaduan'])->name('pengaduan.tolak');
    Route::post('pengaduan/penanganan', [AdminPengaduanController::class, 'penangananPengaduan'])->name('pengaduan.penanganan');
    Route::post('pengaduan/proses', [AdminPengaduanController::class, 'pengaduanProses'])->name('pengaduan.proses');

    // Peta Persebaran Routes
    Route::get('peta', [AdminPetaController::class, 'index'])->name('peta.index')->middleware('permission:Peta');

    // API Routes for roles and permissions
    Route::get('roles', function() {
        return Role::select('id', 'name')->get();
    })->name('roles');

    Route::get('permissions', function() {
        return Permission::select('id', 'name')->get();
    })->name('permissions');
});
