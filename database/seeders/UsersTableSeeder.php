<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'id_users' => Str::uuid(), // Pastikan ini UUID
            'username' => 'admin',
            'name' => 'Administrator',
            'password' => Hash::make('password123'),
            'role_id' => '1', // Masukkan sebagai string, bukan integer
            'login_times' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
