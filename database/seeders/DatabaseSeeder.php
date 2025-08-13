<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Run role seeder first
        $this->call([
            RolePermissionSeeder::class,
        ]);

        // 1. Create User
        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'image' => 'admin.jpg', // Make sure 'image' is a column in users table
        ]);

        // 2. Assign Role
        $user->assignRole('admin');

    }
}
