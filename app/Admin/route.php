<?php

use App\Admin\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

// Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
    Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::put('/roles/{role}', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');
    Route::post('/users/{userId}/roles', [RoleController::class, 'assignRoles'])->name('users.assignRoles');
    Route::get('/users/{userId}/roles', [RoleController::class, 'getUserRoles'])->name('users.getRoles');
});
