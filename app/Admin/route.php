<?php

use App\Admin\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/roles', [RoleController::class, 'index']);
    Route::post('/roles', [RoleController::class, 'store']);
    Route::post('/users/{userId}/roles', [RoleController::class, 'assignRoles']);
    Route::get('/users/{userId}/roles', [RoleController::class, 'getUserRoles']);
});
