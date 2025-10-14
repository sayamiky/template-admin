<?php
namespace App\Services;

use App\Models\User;
use App\Repositories\PermissionRepository;
use Yajra\DataTables\Facades\DataTables;

class PermissionService
{
    protected $permissionRepo;

    public function __construct(PermissionRepository $permissionRepo)
    {
        $this->permissionRepo = $permissionRepo;
    }

    public function getDataTable()
    {
        $data = $this->permissionRepo->getAllPermissions();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $editUrl = route('admin.permissions.edit', $row->id);
                $deleteUrl = route('admin.permissions.destroy', $row->id);
                $editBtn = '<a href="' . $editUrl . '" class="btn btn-sm btn-warning"><i class="ri-edit-line"></i></a>';

                $deleteBtn = '<button class="btn btn-sm btn-danger delete-btn" 
                                    data-url="' . $deleteUrl . '" 
                                    data-name="' . htmlspecialchars($row->name, ENT_QUOTES, 'UTF-8') . '"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#deleteConfirmationModal">
                                    <i class="ri-delete-bin-line"></i>
                              </button>';

                return $editBtn . ' ' . $deleteBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function listPermissions()
    {
        return $this->permissionRepo->getAllPermissions();
    }

    public function createPermission($data)
    {
        return $this->permissionRepo->createPermission($data);
    }

    public function assignPermissionsToUser($userId, array $permissionIds)
    {
        $user = User::findOrFail($userId);
        return $this->permissionRepo->assignPermissionToUser($user, $permissionIds);
    }

    public function getUserPermissions($userId)
    {
        $user = User::findOrFail($userId);
        return $this->permissionRepo->getUserPermissions($user);
    }

    public function getPermissions($permissionId){
        return $this->permissionRepo->findPermissionById($permissionId);
    }

    public function updatePermission($permissionId, $data)
    {
        return $this->permissionRepo->updatePermission($permissionId, $data);
    }

    public function deletePermission($permissionId)
    {
        return $this->permissionRepo->deletePermission($permissionId);
    }
}
