<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman utama dasbor.
     */
    public function index(): View
    {
        return view('dashboard');
    }
}
