<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Halaman root publik
Route::get('/', function () {
    return view('welcome');
});

// Rute Dasbor
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('dashboard');

// Rute Profil Pengguna
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Mengimpor rute-rute autentikasi (login, logout, dll.)
require __DIR__ . '/auth.php';
