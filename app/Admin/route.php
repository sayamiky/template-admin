<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Admin\Controllers\UserController;
use App\Admin\Controllers\RoleController;
use App\Admin\Controllers\PermissionController;
use App\Admin\Controllers\MenuController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
| Semua route admin berada di bawah prefix "admin" dan memiliki nama "admin."
| Middleware 'auth' dan 'role:admin' memastikan hanya admin yang bisa mengakses.
*/

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Users, Roles, Permissions (tanpa 'show' agar aman)
        Route::resource('menus', MenuController::class)->except(['show']);
        Route::resource('users', UserController::class)->except(['show']);
        Route::resource('roles', RoleController::class)->except(['show']);
        Route::resource('permissions', PermissionController::class)->except(['show']);
    });

/*
|--------------------------------------------------------------------------
| Shared Routes (Admin & Operator)
|--------------------------------------------------------------------------
| Bisa diakses oleh admin maupun operator.
*/
Route::middleware(['auth', 'role:admin|operator'])
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.shared');
    });
