<?php

use App\Admin\Controllers\MenuController;
use App\Admin\Controllers\PermissionController;
use App\Admin\Controllers\RoleController;
use App\Admin\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    // Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    // Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
    // Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
    // Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    // Route::put('/roles/{role}', [RoleController::class, 'update'])->name('roles.update');
    // Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');

    // Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
    // Route::get('/permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
    // Route::post('/permissions', [PermissionController::class, 'store'])->name('permissions.store');
    // Route::get('/permissions/{permission}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
    // Route::put('/permissions/{permission}', [PermissionController::class, 'update'])->name('permissions.update');
    // Route::delete('/permissions/{permission}', [PermissionController::class, 'destroy'])->name('permissions.destroy');
    
    // Route::get('users', [UserController::class, 'index'])->name('users.index');
    // Route::get('users/create', [UserController::class, 'create'])->name('users.create');
    // Route::post('users', [UserController::class, 'store'])->name('users.store');
    // Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');
    // Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    // Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');
    // Route::patch('users/{user}', [UserController::class, 'update']);
    // Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    // Route::get('/menus', [MenuController::class, 'index'])->name('menus.index');
    // Route::get('/menus/create', [MenuController::class, 'create'])->name('menus.create');
    // Route::post('/menus', [MenuController::class, 'store'])->name('menus.store');
    // Route::get('/menus/{menu}/edit', [MenuController::class, 'edit'])->name('menus.edit');
    // Route::put('/menus/{menu}', [MenuController::class, 'update'])->name('menus.update');
    // Route::delete('/menus/{menu}', [MenuController::class, 'destroy'])->name('menus.destroy');

    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('users', UserController::class);
    Route::resource('menus', MenuController::class);
});

Route::middleware(['auth', 'role:admin|operator'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
});
