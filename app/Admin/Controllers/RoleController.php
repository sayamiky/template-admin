<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Services\RoleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;
use App\Services\PermissionService;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    protected $roleService;
    protected $permissionService;

    public function __construct(RoleService $roleService, PermissionService $permissionService)
    {
        $this->roleService = $roleService;
        $this->permissionService = $permissionService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->roleService->getDataTable();
        }

        return view('admin.roles.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:roles,name',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $this->roleService->createRole($validator->validated());

            return redirect()->route('roles.index')
                ->with('success', 'Role created successfully.');
        } catch (Exception $e) {
            Log::error('Error creating role: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'An error occurred while creating the role.')
                ->withInput();
        }
    }

    public function assignRoles(Request $request, $userId)
    {
        $request->validate([
            'role_ids' => 'required|array',
            'role_ids.*' => 'integer|exists:roles,id',
        ]);

        $this->roleService->assignRolesToUser($userId, $request->role_ids);

        return redirect()->route('admin.roles.index')
            ->with('success', 'Roles assigned successfully');
    }

    public function getUserRoles($userId)
    {
        $data = $this->roleService->getUserRoles($userId);

        return response()->json($data);
    }


    public function edit(Role $role)
    {
        $role = Role::findOrFail($role->id);
        $rolePermissions = $role->permissions->pluck('name')->toArray();

        // Group permissions by module name
        $permissions = Permission::all();
        $permissionGroups = $permissions->groupBy(function ($perm) {
            return explode(' ', $perm->name)[0]; // e.g. 'User Management Read' -> 'User Management'
        });

        return view('admin.roles.edit', compact('role', 'permissionGroups', 'rolePermissions'));
    }

    public function update(Request $request, Role $role)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
            'permissions' => 'array', // from checkbox
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $this->roleService->updateRole($role->id, $validator->validated());

            return redirect()->route('roles.index')
                ->with('success', 'Role updated successfully.');
        } catch (Exception $e) {
            Log::error('Error updating role: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'An error occurred while updating the role.')
                ->withInput();
        }
    }

    public function destroy(string $id)
    {
        $this->roleService->deleteRole($id);

        return response()->json(['success' => 'Role berhasil dihapus.']);
    }
}
