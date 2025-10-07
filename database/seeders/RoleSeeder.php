<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Buat role 'Admin'
        $adminRole = Role::create(['name' => 'Admin']);

        // Buat role 'User' (untuk penggunaan di masa depan)
        Role::create(['name' => 'User']);

        // Cari atau buat pengguna admin
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('password'),
            ]
        );

        // Tugaskan peran 'Admin' ke pengguna tersebut
        $adminUser->assignRole($adminRole);
    }
}
