<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Repositories\UserRepository;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllUsers()
    {
        return $this->userRepository->getAllUsers();
    }

    public function createUser(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        $user = $this->userRepository->createUser($data);
        if (isset($data['roles'])) {
            $user->assignRole($data['roles']);
        }
        return $user;
    }

    public function updateUser(User $user, array $data)
    {
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $this->userRepository->updateUser($user, $data);

        if (isset($data['roles'])) {
            $user->syncRoles($data['roles']);
        } else {
            $user->syncRoles([]);
        }
    }

    public function deleteUser(User $user)
    {
        return $this->userRepository->deleteUser($user);
    }

    /**
     * Menyiapkan data untuk server-side DataTables.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDataTable()
    {
        $users = $this->userRepository->getAllWithRoles();

        return datatables()->of($users)
            ->addIndexColumn()
            ->addColumn('role', function ($user) {
                return $user->roles->pluck('name')->join(', ');
            })
            ->addColumn('action', function ($user) {
                $editUrl = route('admin.users.edit', $user->id);
                $deleteUrl = route('admin.users.destroy', $user->id);

                $actionButtons = '<a href="' . $editUrl . '" class="btn btn-sm btn-primary me-1"><i class="ri-edit-line"></i></a>';

                $actionButtons .= '<button type="button" class="btn btn-sm btn-danger delete-btn" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#deleteConfirmationModal"
                                        data-url="' . $deleteUrl . '" 
                                        data-name="' . htmlspecialchars($user->name) . '">
                                        <i class="ri-delete-bin-line"></i>
                                    </button>';

                return $actionButtons;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
