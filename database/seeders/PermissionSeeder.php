<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Create permissions for roles and permissions management module start here
        $permissions = [
            'dashboard-view',
            'customers-list',
            'customers-create',
            'customers-edit',
            'customers-delete',
            // 'estimates-list',
            // 'estimates-create',
            // 'estimates-edit',
            // 'estimates-delete',
            // 'estimates-view',
            // 'calendar-list',
            'invoices-list',
            'invoices-create',
            'invoices-edit',
            'invoices-delete',
            // 'projects-list',
            // 'projects-create',
            // 'projects-edit',
            // 'projects-view',
            // 'projects-delete',
            'settings-users-list',
            'settings-users-create',
            'settings-users-edit',
            'settings-users-delete',
            'settings-roles-list',
            'settings-roles-create',
            'settings-roles-edit',
            'settings-roles-delete',
            'account-settings',
            'all'

        ];

        foreach ($permissions as $permission) {
            \Spatie\Permission\Models\Permission::create(['name' => $permission, 'guard_name' => 'sanctum']);
        }

        // create roles
        $roles = [
            'Admin',
            'Manager',
            'Employee',
            'SalesMan'
        ];

        foreach ($roles as $role) {
            \Spatie\Permission\Models\Role::create(['name' => $role, 'guard_name' => 'sanctum']);
        }

        // created permissions ids as array to assign to roles
        $permissions = \Spatie\Permission\Models\Permission::all()->pluck('id')->toArray();

        // assign all permissions to admin role
        \Spatie\Permission\Models\Role::findByName('admin', 'sanctum')->syncPermissions($permissions);

        // assign admin role to admin user
        \App\Models\User::find(1)->assignRole('admin');

    }
}
