<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed roles and permissions
        $this->call(RolePermissionSeeder::class);

        // Create admin user
        $admin = User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'admin@sitaru.test',
            'username' => 'admin',
            'active' => 1,
        ]);
        
        // Assign Super Admin role
        $admin->assignRole('Super Admin');

        // Create test user
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'username' => 'testuser',
            'active' => 1,
        ]);
        
        // Assign User role
        $user->assignRole('User');
    }
}
