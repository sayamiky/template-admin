<?php

namespace App\Http\Controllers;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $userCount = User::count();
        $roleCount = Role::count();

        return view('dashboard', compact('userCount', 'roleCount'));
    }
}
