<?php

namespace App\Repositories;

use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Spatie\Permission\Models\Role;

class RoleRepository
{
    /**
     * Get all roles.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllRoles()
    {
        return Role::all();
    }

    /**
     * Find a role by ID.
     *
     * @param int $id
     * @return Role
     */
    public function findRoleById($id)
    {
        return Role::findOrFail($id);
    }

    /**
     * Create a new role.
     *
     * @param array $data
     * @return Role
     */
    public function createRole(array $data)
    {
        return Role::create(array_merge($data, ['guard_name' => 'web']));
    }

    /**
     * Update an existing role.
     *
     * @param int $id
     * @param array $data
     * @return Role
     */
    public function updateRole($id, array $data)
    {
        $role = $this->findRoleById($id);

        $role->update($data);
        return $role;
    }

    /**
     * Delete a role by ID.
     *
     * @param int $id
     * @return bool
     */
    public function deleteRole($id)
    {
        $role = $this->findRoleById($id);
        return $role->delete();
    }


    /**
     * Assign roles to a user.
     *
     * @param \App\Models\User $user
     * @param array $roleIds
     * @return void
     */
    public function assignRoleToUser($user, array $roleIds)
    {
        return $user->roles()->sync($roleIds);
    }

    /**
     * Get roles assigned to a user.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getUserRoles($user)
    {
        return $user->roles;
    }

    /**
     * Sync permissions for a role.
     *
     * @param Role $role
     * @param array $permissions
     */
    public function syncPermissions(Role $role, array $permissions)
    {
        return $role->syncPermissions($permissions);
    }
}
