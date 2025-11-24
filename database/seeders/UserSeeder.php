<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Akun utama buat login Breeze
        User::factory()->create([
            'name' => 'Muhammad Alif Abrar',
            'email' => 'lif@example.com',
            'password' => Hash::make('password'), // bisa login pakai ini
        ]);

        // 5 user tambahan random
        User::factory(5)->create();
    }
}
