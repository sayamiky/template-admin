<?php

namespace App\Services;
use App\Models\User;
use App\Repositories\RoleRepository;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class RoleService
{
    protected $roleRepo;

    public function __construct(RoleRepository $roleRepo)
    {
        $this->roleRepo = $roleRepo;
    }

    public function getAllRoles()
    {
        return $this->roleRepo->getAllRoles();
    }

    public function getDataTable()
    {
        $data = $this->roleRepo->getAllRoles();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $editUrl = route('admin.roles.edit', $row->id);
                $deleteUrl = route('admin.roles.destroy', $row->id);
                $editBtn = '<a href="' . $editUrl . '" class="btn btn-sm btn-warning"><i class="ri-edit-line"></i></a>';

                // Tombol Hapus dengan atribut untuk memicu modal
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

    public function deleteRole(Role $role)
    {
        // Teruskan objek $role, bukan ID
        return $this->roleRepo->deleteRole($role);
    }
}