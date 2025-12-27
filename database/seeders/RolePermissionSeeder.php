<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create Permissions
        $permissions = [
            'manage employees',
            'view employees',
            'manage payroll',
            'view payroll',
            'manage attendance',
            'view attendance',
            'manage performance',
            'manage recruitment',
            'manage settings',
            'view audit logs',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create Roles and Assign Permissions
        $superAdmin = Role::firstOrCreate(['name' => 'Super Admin']);
        $superAdmin->givePermissionTo(Permission::all());

        $hrManager = Role::firstOrCreate(['name' => 'HR Manager']);
        $hrManager->givePermissionTo([
            'manage employees',
            'view employees',
            'manage payroll',
            'manage attendance',
            'manage performance',
            'manage recruitment',
        ]);

        $accountant = Role::firstOrCreate(['name' => 'Accountant']);
        $accountant->givePermissionTo([
            'view employees',
            'manage payroll',
            'view payroll',
        ]);

        $deptHead = Role::firstOrCreate(['name' => 'Department Head']);
        $deptHead->givePermissionTo([
            'view employees',
            'view attendance',
            'manage performance',
        ]);

        $employee = Role::firstOrCreate(['name' => 'Employee']);
        $employee->givePermissionTo([
            'view attendance',
        ]);
    }
}
