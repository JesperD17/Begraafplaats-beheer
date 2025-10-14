<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Roles;
use App\Models\Permissions;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Standard roles
        Roles::create([
            'name' => 'user',
            'permissionID' => 1,
        ]);

        Roles::create([
            'name' => 'editor',
            'permissionID' => 2,
        ]);

        Roles::create([
            'name' => 'admin',
            'permissionID' => 3,
        ]);

        Roles::create([
            'name' => 'super admin',
            'permissionID' => 4,
        ]);

        // Standard roles
        // example
        Permissions::create(['perm name' => 'r']);
        Permissions::create(['perm name' => 'r, w, d']);

        // Test users - remove in production
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'role_id' => 1,
        ]);

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role_id' => 3,
        ]);
    }
}
