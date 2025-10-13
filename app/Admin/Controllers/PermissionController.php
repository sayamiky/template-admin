<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Services\PermissionService;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    protected $permissionService;

    public function __construct(PermissionService $permissionService)
    {
        $this->permissionService = $permissionService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->permissionService->getDataTable();
        }
        return view('admin.permissions.index');
    }

    public function create()
    {
        return view('admin.permissions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name',
        ]);

        $this->permissionService->createPermission($request->only('name'));

        return redirect()->route('admin.permissions.index')->with('success', 'Permission created successfully.');
    }

    public function edit($id)
    {
        $permission = $this->permissionService->getPermissions($id);
        return view('admin.permissions.edit', compact('permission'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name,' . $id,
        ]);

        $this->permissionService->updatePermission($id, $request->only('name'));

        return redirect()->route('admin.permissions.index')->with('success', 'Permission edit successfully.');
    }

    public function destroy($id)
    {
        $this->permissionService->deletePermission($id);
        
        return response()->json(['success' => 'Permission berhasil dihapus.']);
    }
}
