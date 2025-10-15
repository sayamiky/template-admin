<?php

use App\Admin\Controllers\MenuController;
use App\Admin\Controllers\PermissionController;
use App\Admin\Controllers\RoleController;
use App\Admin\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Models\Menu;
use Illuminate\Support\Facades\Route;

// Route::middleware(['auth'])->prefix('dynamic')->group(function () {
//     // Fetch all menus with a non-null route
//     $menus = Menu::whereNotNull('route')->get();

//     foreach ($menus as $menu) {
//         $menuName = str_replace('.', '/', trim($menu->route, '/'));
//         if (!Route::has($menuName)) {
//             Route::get($menuName, function () use ($menu) {
//                 return view('admin.dynamic.' . $menu->name, ['menu' => $menu]);
//             })->name($menu->route);
//         }
//     }
// });

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Users, Roles, Permissions (tanpa 'show' agar aman)
        Route::resource('users', UserController::class)->except(['show']);
        Route::resource('roles', RoleController::class)->except(['show']);
        Route::resource('permissions', PermissionController::class)->except(['show']);
        Route::resource('menus', MenuController::class)->except(['show']);
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

        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    });
