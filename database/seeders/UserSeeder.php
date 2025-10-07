<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Nonaktifkan pengecekan foreign key untuk sementara
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Kosongkan tabel users sebelum diisi
        User::truncate();

        // Buat satu pengguna (misalnya, Super Admin)
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // Ganti 'password' dengan password yang aman
        ]);

        // Aktifkan kembali pengecekan foreign key
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
