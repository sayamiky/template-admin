<?php

namespace App\Services;
use App\Models\User;
use App\Repositories\RoleRepository;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleService
{
    protected $roleRepo;

    public function __construct(RoleRepository $roleRepo)
    {
        $this->roleRepo = $roleRepo;
    }

    public function listRoles()
    {
        return $this->roleRepo->getAllRoles();
    }

    public function createRole($data)
    {
        return $this->roleRepo->createRole($data);
    }

    public function assignRolesToUser($userId, array $roleIds)
    {
        $user = User::findOrFail($userId);
        return $this->roleRepo->assignRoleToUser($user, $roleIds);
    }

    public function getUserRoles($userId)
    {
        $user = User::findOrFail($userId);
        return $this->roleRepo->getUserRoles($user);
    }

    public function updateRole($roleId, $data)
    {
        DB::transaction(function () use ($roleId, $data) {
            $this->roleRepo->updateRole($roleId, $data);

            // Update permission (sync)
            $this->roleRepo->syncPermissions(Role::findOrFail($roleId), $data['permissions'] ?? []);
        });
    }

    public function deleteRole($roleId)
    {
        return $this->roleRepo->deleteRole($roleId);
    }
}