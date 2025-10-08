<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['admin', 'operator', 'supervisor'];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role, 'guard_name' => 'web']);
        }

        $permissions = [
            'user.view',
            'user.create',
            'user.edit',
            'user.delete',
            'menu.view',
            'menu.create',
            'menu.edit',
            'menu.delete',
            'role.view',
            'role.create',
            'role.delete',
            'role.edit',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // give all permissions to admin only
        $adminRole = Role::where('name', 'admin')->first();
        $adminRole->syncPermissions(Permission::all());

        $users = User::all();
        foreach ($users as $user) {
            $role = Role::inRandomOrder()->first();
            $user->assignRole($role);
        }
    }
}
