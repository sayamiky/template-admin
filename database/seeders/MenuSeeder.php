<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('menus')->insert([
            [
                'name' => 'manajemen sistem',
                'route' => 'dashboard',
                'icon' => 'fa-bars',
                'order' => 1,
                'is_active' => 1,
                'parent_id' => null,
            ],
            [
                'name' => 'role',
                'route' => 'admin.roles.index',
                'icon' => 'fa-bars',
                'order' => 2,
                'is_active' => 1,
                'parent_id' => 1,
            ],
            [
                'name' => 'user',
                'route' => 'admin.users.index',
                'icon' => 'fa user',
                'order' => 1,
                'is_active' => 1,
                'parent_id' => 1,
            ],
            [
                'name' => 'permission',
                'route' => 'admin.permissions.index',
                'icon' => 'fa-bars',
                'order' => 3,
                'is_active' => 1,
                'parent_id' => 1,
            ],
            [
                'name' => 'submission',
                'route' => 'admin.submissions.index',
                'icon' => 'fa-bars',
                'order' => 2,
                'is_active' => 0,
                'parent_id' => null,
            ],
            [
                'name' => 'menu',
                'route' => 'admin.menus.index',
                'icon' => 'fa-bars',
                'order' => 3,
                'is_active' => 1,
                'parent_id' => 1,
            ],
        ]);
    }
}
