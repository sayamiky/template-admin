<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Spatie\Permission\Models\Role;

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

        // [PERBAIKAN] Ambil objek Role berdasarkan ID sebelum assign
        $roles = Role::whereIn('id', $validatedData['roles'])->get();
        $user->assignRole($roles);

        return $user;
    }

    /**
     * Memperbarui data pengguna.
     *
     * @param User $user
     * @param array $validatedData
     * @return bool
     */
    public function updateUser(User $user, array $validatedData): bool
    {
        $updateData = [
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
        ];

        if (! empty($validatedData['password'])) {
            $updateData['password'] = bcrypt($validatedData['password']);
        }

        $this->userRepository->updateUser($user, $updateData);

        // [PERBAIKAN] Ambil objek Role berdasarkan ID sebelum sync
        $roles = Role::whereIn('id', $validatedData['roles'])->get();
        $user->syncRoles($roles);

        return true;
    }

    public function deleteUser(User $user): ?bool
    {
        return $this->userRepository->deleteUser($user);
    }
}
