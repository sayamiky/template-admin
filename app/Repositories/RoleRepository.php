<?php

namespace App\Repositories;

// Kita tidak lagi menggunakan "use App\Models\Role;" di sini untuk menghindari ambiguitas
// Langsung gunakan model dari Spatie sebagai dasar
use Spatie\Permission\Models\Role;

class RoleRepository
{
    protected $role;

    /**
     * =================================================================
     * // PERUBAHAN UTAMA ADA DI SINI
     * // Kita tidak lagi meng-inject model secara langsung.
     * // Sebaliknya, kita membuat instance baru dari model yang benar.
     * // Ini menyelesaikan masalah BindingResolutionException.
     * =================================================================
     */
    public function __construct()
    {
        // Gunakan model Role yang sudah dikonfigurasi di config/permission.php
        $this->role = new (config('permission.models.role'));
    }

    public function create(array $data)
    {
        return $this->role->create($data);
    }

    public function update($id, array $data)
    {
        $role = $this->role->find($id);
        $role->update($data);
        return $role;
    }

    public function delete($id)
    {
        return $this->role->destroy($id);
    }

    /**
     * Mengambil semua data role dari database.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->role->all();
    }
}
