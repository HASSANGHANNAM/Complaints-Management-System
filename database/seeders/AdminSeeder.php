<?php

namespace Database\Seeders;

use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function __construct(
        private UserRepositoryInterface $userRepo,
    ) {}

    public function run(): void
    {
        $admin = [
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
            'IdFrontFace' => 'users/id_cards/2025/11/front_0ac43fa6-7109-4644-92b9-8a3a2713ae85.png',
            'IdBackFace' => 'users/id_cards/2025/11/back_5080fa7d-1d0b-42fa-b548-a5087842997d.png',
            'CurrentLocationAr' => 'دمشق',
            'CurrentLocationEn' => 'Damascus',
            'ContactNumber' => '+963123456789',
            'Email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'email_verified_at' => now(),
        ];
        DB::transaction(function () use ($admin) {
            $thisAdmin = $this->userRepo->create($admin);
            $this->userRepo->assignRole($thisAdmin, 'admin');
        });
    }
}
