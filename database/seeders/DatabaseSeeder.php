<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            RolesAndPermissionsSeeder::class,
            AdminSeeder::class,
            UsersSeeder::class,
            GovernmentAgenciesSeeder::class,
            GovernmentAgencySectionsSeeder::class,
            GovernmentAgencySectionServicesSeeder::class,
            GovernmentAgencyEmployeesSeeder::class,
            ComplaintsSeeder::class,
            ComplaintStatusesSeeder::class,
            ComplaintResponsesSeeder::class,
            MediaSeeder::class,
        ]);
    }
}
