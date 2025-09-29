<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            // User Management
            'User',
            'User Create',
            'User Edit',
            'User Delete',
            'User View',
            
            // Role Management
            'Role',
            'Role Create',
            'Role Edit',
            'Role Delete',
            'Role View',
            
            // Permission Management
            'Permission',
            'Permission Create',
            'Permission Edit',
            'Permission Delete',
            'Permission View',
            
            // KKPR Management
            'KKPR',
            'KKPR Create',
            'KKPR Edit',
            'KKPR Delete',
            'KKPR View',
            'KKPR Approve',
            
            // KRK Management
            'KRK',
            'KRK Create',
            'KRK Edit',
            'KRK Delete',
            'KRK View',
            'KRK Approve',
            
            // Advanced Planning
            'Advanced Planning',
            'Advanced Planning Create',
            'Advanced Planning Edit',
            'Advanced Planning Delete',
            'Advanced Planning View',
            'Advanced Planning Approve',
            
            // Settings
            'Settings',
            'Settings General',
            'Settings System',
            
            // Reports
            'Reports',
            'Reports View',
            'Reports Export',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'web']);
        }

        // Create roles
        $superAdmin = Role::create(['name' => 'Super Admin', 'guard_name' => 'web']);
        $admin = Role::create(['name' => 'Admin', 'guard_name' => 'web']);
        $petugas = Role::create(['name' => 'Petugas', 'guard_name' => 'web']);
        $kepala = Role::create(['name' => 'Kepala Seksi', 'guard_name' => 'web']);
        $user = Role::create(['name' => 'User', 'guard_name' => 'web']);

        // Assign permissions to roles
        $superAdmin->givePermissionTo(Permission::all());
        
        $admin->givePermissionTo([
            'User', 'User Create', 'User Edit', 'User View',
            'KKPR', 'KKPR Create', 'KKPR Edit', 'KKPR View', 'KKPR Approve',
            'KRK', 'KRK Create', 'KRK Edit', 'KRK View', 'KRK Approve',
            'Advanced Planning', 'Advanced Planning Create', 'Advanced Planning Edit', 'Advanced Planning View', 'Advanced Planning Approve',
            'Reports', 'Reports View', 'Reports Export',
            'Settings', 'Settings General',
        ]);
        
        $petugas->givePermissionTo([
            'KKPR', 'KKPR Create', 'KKPR Edit', 'KKPR View',
            'KRK', 'KRK Create', 'KRK Edit', 'KRK View',
            'Advanced Planning', 'Advanced Planning Create', 'Advanced Planning Edit', 'Advanced Planning View',
            'Reports', 'Reports View',
        ]);
        
        $kepala->givePermissionTo([
            'KKPR', 'KKPR View', 'KKPR Approve',
            'KRK', 'KRK View', 'KRK Approve',
            'Advanced Planning', 'Advanced Planning View', 'Advanced Planning Approve',
            'Reports', 'Reports View',
        ]);
        
        $user->givePermissionTo([
            'KKPR', 'KKPR Create', 'KKPR View',
            'KRK', 'KRK Create', 'KRK View',
            'Advanced Planning', 'Advanced Planning Create', 'Advanced Planning View',
        ]);
    }
}
