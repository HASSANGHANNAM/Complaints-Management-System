<?php

namespace Database\Seeders;

use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function __construct(
        private UserRepositoryInterface $userRepo,
    ) {}

    public function run(): void
    {
        $users = [
            [
                'FirstnameAr' => 'حسان',
                'FirstnameEn' => 'Hassan',
                'LastnameAr' => 'غنام',
                'LastnameEn' => 'Ghanam',
                'MiddlenameAr' => 'محمد',
                'MiddlenameEn' => 'Mohammad',
                'BirthPlaceAr' => 'النبك',
                'BirthPlaceEn' => 'Alnabek',
                'BirthDate' => '2003-06-01',
                'NationalNumber' => '03180032345',
                'IdFrontFace' => 'users/id_cards/2025/11/front_0ac43fa6-7109-4644-92b9-8a3a2713ae85.png',
                'IdBackFace' => 'users/id_cards/2025/11/back_5080fa7d-1d0b-42fa-b548-a5087842997d.png',
                'CurrentLocationAr' => 'النبك',
                'CurrentLocationEn' => 'Alnabek',
                'ContactNumber' => '+963934519102',
                'Email' => 'hassan@gmail.com',
                'password' => Hash::make('hassan123'),
                'email_verified_at' => now(),
            ],
            [
                'FirstnameAr' => 'غيث',
                'FirstnameEn' => 'Ghaith',
                'LastnameAr' => 'أبو راشد',
                'LastnameEn' => 'Abo Rashed',
                'MiddlenameAr' => 'حمزة',
                'MiddlenameEn' => 'Hamza',
                'BirthPlaceAr' => 'دمشق',
                'BirthPlaceEn' => 'Damascus',
                'BirthDate' => '2003-11-01',
                'NationalNumber' => '03180032346',
                'IdFrontFace' => 'users/id_cards/2025/11/front_c588f73e-8e48-4d91-a44f-1c08bfad07a1.png',
                'IdBackFace' => 'users/id_cards/2025/11/back_01fea9ed-4c46-4561-94c0-4c7de6156e26.png',
                'CurrentLocationAr' => 'دمشق',
                'CurrentLocationEn' => 'Damascus',
                'ContactNumber' => '+963954563434',
                'Email' => 'ghaith@gmail.com',
                'password' => Hash::make('ghaith123'),
                'email_verified_at' => now(),
            ]
        ];
        foreach ($users as $user) {
            DB::transaction(function () use ($user) {
                $thisUser = $this->userRepo->create($user);
                $this->userRepo->assignRole($thisUser, 'user');
            });
        }
    }
}
