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
            'get complaint details',
            'agencyManager',
            'employee',
            'get complaint respons',
            'create complaint respons',
            'create respons',
            'get Tracing',
            'get full agencies',
            'get services'
        ];
        foreach ($permissions as $permissionsname) {
            Permission::findOrCreate($permissionsname);
        }

        $adminRole->givePermissionTo([
            'get full agencies'
        ]);
        $userRole->givePermissionTo([
            'create complaints',
            'get agencies',
            'get agency sections',
            'get my complaints',
            'get complaint details',
            'get complaint respons',
            'create respons',
            'get Tracing'
        ]);
        $employeeRole->givePermissionTo([
            'create complaint respons',
            'create respons'
        ]);
        $agencyManagerRole->givePermissionTo([
            'agencyManager',
            'get services'
        ]);

        // $admin->assignRole($adminRole);
        // $permissions = $admin->permissions()->pluck('name')->toArray();
        // $admin->givePermissionTo($permissions);
    }
}
