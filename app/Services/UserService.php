<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
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

    public function getAllRoles()
    {
        return Role::all();
    }

    public function storeUser(array $validatedData): User
    {
        $validatedData['password'] = Hash::make($validatedData['password']);

        $user = $this->userRepository->createUser($validatedData);
        $user->syncRoles($validatedData['roles']);

        return $user;
    }

    public function updateUser(User $user, array $validatedData): bool
    {
        $updateData = [
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
        ];

        if (!empty($validatedData['password'])) {
            $updateData['password'] = Hash::make($validatedData['password']);
        }

        $this->userRepository->updateUser($user, $updateData);
        $user->syncRoles($validatedData['roles']);

        return true;
    }

    public function deleteUser(User $user): bool
    {
        return $this->userRepository->deleteUser($user);
    }
}
