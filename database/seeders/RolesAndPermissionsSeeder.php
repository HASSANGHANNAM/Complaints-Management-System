<?php

namespace Database\Seeders;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);
        $employeeRole = Role::create(['name' => 'employee']);
        $agencyManagerRole = Role::create(['name' => 'agencyManager']);

        $permissions = [
            'view posts',
            'publish posts'
        ];

        foreach ($permissions as $permissionsname) {
            Permission::findOrCreate($permissionsname);
        }




        $adminRole->givePermissionTo(Permission::all());
        $userRole->givePermissionTo([]);
        $employeeRole->givePermissionTo([]);
        $agencyManagerRole->givePermissionTo([]);

        $admin =  User::factory()->create([
            'FirstnameAr' => 'أدمن',
            'FirstnameEn' => 'Admin',
            'LastnameAr' => 'النظام',
            'LastnameEn' => 'System',
            'MiddlenameAr' => 'مدير',
            'MiddlenameEn' => 'Manager',
            'BirthPlaceAr' => 'دمشق',
            'BirthPlaceEn' => 'Damascus',
            'BirthDate' => '1990-01-01',
            'NationalNumber' => '1234567890',
            'IdFrontFace' => 'default_front.jpg',
            'IdBackFace' => 'default_back.jpg',
            'CurrentLocationAr' => 'دمشق',
            'CurrentLocationEn' => 'Damascus',
            'ContactNumber' => '+963123456789',
            'Email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'email_verified_at' => now(),
        ]);
        $admin->assignRole($adminRole);

        $permissions = $admin->permissions()->pluck('name')->toArray();
        $admin->givePermissionTo($permissions);
    }
}
