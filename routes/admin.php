<?php

use App\Http\Controllers\Admin\AdminUserController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

Route::prefix('admin')->name('admin.')->middleware(['auth', 'permission:User'])->group(function () {
    // User Management Routes
    Route::resource('users', AdminUserController::class);
    Route::post('users/{user}/toggle-status', [AdminUserController::class, 'toggleStatus'])->name('users.toggle-status');
    Route::get('users/{user}/reset-password', [AdminUserController::class, 'resetPassword'])->name('users.reset-password');
    Route::patch('users/{user}/update-password', [AdminUserController::class, 'updatePassword'])->name('users.update-password');
    
    // API Routes for roles and permissions
    Route::get('roles', function() {
        return Role::select('id', 'name')->get();
    })->name('roles');
    
    Route::get('permissions', function() {
        return Permission::select('id', 'name')->get();
    })->name('permissions');
});
