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
     * @throws ModelNotFoundException
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
     * @throws Exception
     */
    public function createRole(array $data)
    {
        try {
            return Role::create($data);
        } catch (Exception $e) {
            Log::error('Error creating role: ' . $e->getMessage());
            throw new Exception('An error occurred while creating the role.');
        }   
    }   

    /**
     * Update an existing role.
     *
     * @param int $id
     * @param array $data
     * @return Role
     * @throws ModelNotFoundException
     * @throws Exception
     */
    public function updateRole($id, array $data)
    {
        $role = $this->findRoleById($id);

        try {
            $role->update($data);
            return $role;
        } catch (Exception $e) {
            Log::error('Error updating role: ' . $e->getMessage());
            throw new Exception('An error occurred while updating the role.');
        }   
    }

    /**
     * Delete a role by ID.
     *
     * @param int $id
     * @return bool
     * @throws ModelNotFoundException
     * @throws Exception
     */
    public function deleteRole($id)
    {
        $role = $this->findRoleById($id);

        try {
            return $role->delete();
        } catch (Exception $e) {
            Log::error('Error deleting role: ' . $e->getMessage());
            throw new Exception('An error occurred while deleting the role.');
        }   
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
