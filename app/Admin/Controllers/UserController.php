<?php

namespace App\Admin\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\RoleService;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use App\Services\PermissionService;
use App\Admin\Requests\User\StoreUserRequest;
use App\Admin\Requests\User\UpdateUserRequest;
use App\Http\Requests\User\StoreUserRequest as UserStoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest as UserUpdateUserRequest;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    protected $userService;
    protected $roleService;
    protected $permissionService;

    public function __construct(UserService $userService, RoleService $roleService, PermissionService $permissionService)
    {
        $this->userService = $userService;
        $this->roleService = $roleService;
        $this->permissionService = $permissionService;
    }

    /**
     * Menampilkan halaman daftar pengguna.
     * Logika diubah untuk menangani permintaan AJAX dari DataTables.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->userService->getDataTable();
        }

        return view('admin.users.index');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = $this->roleService->getAllRoles();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreUserRequest $request)
    {
        $this->userService->createUser($request->validated());

        return redirect()->route('admin.users.index')
            ->with('success', 'User created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = $this->roleService->getAllRoles();
        $userRoles = $user->roles->pluck('name')->all();
        return view('admin.users.edit', compact('user', 'roles', 'userRoles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'roles' => 'sometimes|array',
        ]);

        $this->userService->updateUser($user, $validatedData);

        return redirect()->route('admin.users.index')
            ->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $this->userService->deleteUser($user);

        return response()->json(['success' => 'Pengguna berhasil dihapus.']);
    }
}
