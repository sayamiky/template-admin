<?php

namespace App\Repositories;

use Spatie\Permission\Models\Permission;

class PermissionRepository
{
    /**
     * Get all permissions.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllPermissions()
    {
        return Permission::all();
    }

    /**
     * Find a permission by ID.
     *
     * @param int $id
     * @return Permission
     */
    public function findPermissionById($id)
    {
        return Permission::findOrFail($id);
    }

    /**
     * Create a new permission.
     *
     * @param array $data
     * @return Permission
     */
    public function createPermission(array $data)
    {
        return Permission::create(array_merge($data, ['guard_name' => 'web']));
    }

    /**
     * Update an existing permission.
     *
     * @param int $id
     * @param array $data
     * @return Permission
     */
    public function updatePermission($id, array $data)
    {
        $permission = $this->findPermissionById($id);

        $permission->update($data);
        return $permission;
    }

    /**
     * Delete a permission by ID.
     *
     * @param int $id
     * @return bool|null
     */
    public function deletePermission($id)
    {
        $permission = $this->findPermissionById($id);
        return $permission->delete();
    }

    /**
     * Assign permissions to a user.
     *
     * @param \App\Models\User $user
     * @param array $permissionIds
     * @return \App\Models\User
     */
    public function assignPermissionToUser($user, array $permissionIds)
    {
        $permissions = Permission::whereIn('id', $permissionIds)->get();
        $user->syncPermissions($permissions);
        return $user;
    }

    /**
     * Get permissions assigned to a user.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getUserPermissions($user)
    {
        return $user->getAllPermissions();
    }
}
