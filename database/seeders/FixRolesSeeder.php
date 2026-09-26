<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FixRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // This will reset the roles table to have only admin (id=1) and resident (id=2)
        // and remap users: admin@example.com => 1, others => 2.

        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        // Truncate roles safely
        DB::table('roles')->truncate();

        $now = Carbon::now();

        DB::table('roles')->insert([
            [
                'id' => 1,
                'name' => 'admin',
                'display_name' => 'Administrator',
                'description' => 'System Administrator',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 2,
                'name' => 'resident',
                'display_name' => 'Resident',
                'description' => 'Barangay Resident',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        // Map admin email to admin role id (1) if exists
        DB::table('users')->where('email', 'admin@example.com')->update(['role_id' => 1]);

        // Set everyone else to resident (2)
        DB::table('users')->where('email', '<>', 'admin@example.com')->update(['role_id' => 2]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
