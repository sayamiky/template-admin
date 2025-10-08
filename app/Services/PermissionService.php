<?php
namespace App\Services;

use App\Models\User;
use App\Repositories\PermissionRepository;

class PermissionService
{
    protected $permissionRepo;

    public function __construct(PermissionRepository $permissionRepo)
    {
        $this->permissionRepo = $permissionRepo;
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
