<?php

use App\Admin\Controllers\MenuController;
use App\Admin\Controllers\PermissionController;
use App\Admin\Controllers\RoleController;
use App\Admin\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Models\Menu;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
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

Route::middleware(['auth'])->prefix('dynamic')->group(function () {
    // Fetch all menus with a non-null route
    $menus = Menu::whereNotNull('route')->get();

    foreach ($menus as $menu) {
        if (!Route::has($menu->route)) {
            Route::get($menu->route, function () use ($menu) {
                return view('admin.dynamic.' . $menu->name, ['menu' => $menu]);
            })->name(str_replace('/', '.', trim($menu->route, '/')));
        }
    }
});
