<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    /**
     * Mengambil semua data pengguna.
     */
    public function getAllUsers()
    {
        return User::latest()->get();
    }

    /**
     * [BARU] Mengambil semua user dengan relasi roles-nya.
     * Menggunakan with('roles') adalah best practice untuk Eager Loading,
     * ini mencegah N+1 problem saat mengambil relasi.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllWithRoles()
    {
        return User::with('roles')->latest();
    }

    /**
     * [BARU] Menemukan pengguna berdasarkan ID.
     * Method ini ditambahkan untuk mengatasi error 'Call to undefined method'.
     *
     * @param int $id
     * @return User|null
     */
    public function find(int $id): ?User
    {
        return User::find($id);
    }

    /**
     * Membuat pengguna baru.
     *
     * @param array $data
     * @return User
     */
    public function createUser(array $data): User
    {
        return User::create($data);
    }

    /**
     * Memperbarui data pengguna.
     *
     * @param User $user
     * @param array $data
     * @return bool
     */
    public function updateUser(User $user, array $data): bool
    {
        return $user->update($data);
    }

    /**
     * Menghapus pengguna.
     *
     * @param User $user
     * @return bool|null
     */
    public function deleteUser(User $user): ?bool
    {
        return $user->delete();
    }
}
