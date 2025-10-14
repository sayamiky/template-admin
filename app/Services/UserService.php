<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

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

    public function createUser(array $validatedData): User
    {
        $userData = [
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ];

        $user = $this->userRepository->createUser($userData);

        $roles = Role::whereIn('id', $validatedData['roles'])->get();
        $user->assignRole($roles);

        return $user;
    }

    /**
     * Memperbarui data pengguna.
     *
     * @param User $user
     * @param array $validatedData
     * @return User
     */
    public function updateUser(User $user, array $validatedData): User
    {
        return DB::transaction(function () use ($user, $validatedData) {
            $updatedUser = $this->userRepository->updateUser($user, $validatedData);
            
            if (isset($validatedData['roles'])) {
                $this->userRepository->syncRoles($updatedUser, $validatedData['roles']);
            }

            return $updatedUser;
        });
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

                $actionButtons = '<a href="' . $editUrl . '" class="btn btn-sm btn-warning me-1"><i class="ri-edit-line"></i></a>';

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
