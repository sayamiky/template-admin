<?php

namespace App\Http\Controllers;

use App\Models\User; // 1. Impor model User
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 2. Ambil semua data pengguna
        $users = User::all();

        // 3. Kirim data ke view
        return view('users.index', compact('users'));
    }
}
