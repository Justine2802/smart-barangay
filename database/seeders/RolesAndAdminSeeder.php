<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;

class RolesAndAdminSeeder extends Seeder
{
    public function run(): void
    {
        // Create roles
        $roles = [
            [
                'name' => 'admin',
                'display_name' => 'Administrator',
                'description' => 'System Administrator'
            ],
            [
                'name' => 'user',
                'display_name' => 'User',
                'description' => 'Regular user'
            ]
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role['name']], $role);
        }

        // Create admin user if not exists
        $adminRole = Role::where('name', 'admin')->first();
        if ($adminRole) {
            User::firstOrCreate([
                'email' => 'admin@example.com',
            ], [
                'role_id' => $adminRole->id,
                'first_name' => 'Admin',
                'last_name' => 'User',
                'password' => bcrypt('password'),
                'phone_number' => '1234567890',
                'complete_address' => 'Admin Address',
                'is_active' => true
            ]);
        }
    }
}