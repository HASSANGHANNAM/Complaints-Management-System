<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);
        $employeeRole = Role::create(['name' => 'employee']);
        $agencyManagerRole = Role::create(['name' => 'agencyManager']);
        $permissions = [
            'create complaints',
            'get agencies',
            'get agency sections',
            'get my complaints',
            'get complaint details'
        ];
        foreach ($permissions as $permissionsname) {
            Permission::findOrCreate($permissionsname);
        }

        $adminRole->givePermissionTo([]);
        $userRole->givePermissionTo([
            'create complaints',
            'get agencies',
            'get agency sections',
            'get my complaints',
            'get complaint details'
        ]);
        $employeeRole->givePermissionTo([]);
        $agencyManagerRole->givePermissionTo([]);

        // $admin->assignRole($adminRole);
        // $permissions = $admin->permissions()->pluck('name')->toArray();
        // $admin->givePermissionTo($permissions);
    }
}
