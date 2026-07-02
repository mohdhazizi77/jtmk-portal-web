<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Your clean, resource-action sorted permissions array
        $permissions = [
            'permission_management-view',
            'permission_management-create',
            'permission_management-edit',
            'permission_management-delete',

            'role_management-view',
            'role_management-create',
            'role_management-edit',
            'role_management-delete',

            'user_management-view',
            'user_management-create',
            'user_management-edit',
            'user_management-delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Super Admin gets everything
        $superAdmin = Role::create(['name' => 'Super Admin']);
        $superAdmin->givePermissionTo(Permission::all());

        // Admin gets only user management permissions
        $admin = Role::create(['name' => 'Admin']);
        $admin->givePermissionTo([
            'user_management-view',
            'user_management-create',
            'user_management-edit',
            'user_management-delete',
        ]);
    }
}
