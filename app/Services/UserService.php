<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\DB;
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

    public function getUserById(int $id): ?User
    {
        return $this->userRepository->find($id);
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

    public function deleteUser(User $user): ?bool
    {
        return $this->userRepository->deleteUser($user);
    }
}
