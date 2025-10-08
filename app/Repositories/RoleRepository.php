<?php

namespace App\Repositories;

use App\Models\Role;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
     * @throws Exception
     */
    public function assignRoleToUser($user, array $roleIds)
    {
        try {
            $user->roles()->sync($roleIds);
        } catch (Exception $e) {
            Log::error('Error assigning roles to user: ' . $e->getMessage());
            throw new Exception('An error occurred while assigning roles to the user.');
        }
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
}
