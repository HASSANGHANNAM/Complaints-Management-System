<?php

namespace Database\Seeders;

use App\Repositories\Contracts\GovernmentAgencyRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class GovernmentAgenciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function __construct(
        private GovernmentAgencyRepositoryInterface $governmentAgencyRepo,
        private UserRepositoryInterface $userRepo,
    ) {}

    public function run(): void
    {
        $managers = [
            [
                'FirstnameAr' => 'أحمد',
                'FirstnameEn' => 'Ahmed',
                'LastnameAr' => 'الخالد',
                'LastnameEn' => 'Al-Khaled',
                'MiddlenameAr' => 'محمد',
                'MiddlenameEn' => 'Mohammed',
                'BirthPlaceAr' => 'دمشق',
                'BirthPlaceEn' => 'Damascus',
                'BirthDate' => '1975-03-15',
                'NationalNumber' => '1975031512345',
                'IdFrontFace' => 'users/id_cards/2025/11/front_270b5c19-a8a9-40d6-a54e-ae3ebbf9cc47.png',
                'IdBackFace' => 'users/id_cards/2025/11/back_270b5c19-a8a9-40d6-a54e-ae3ebbf9cc47.png',
                'CurrentLocationAr' => 'دمشق - ساحة الأمويين',
                'CurrentLocationEn' => 'Damascus - Umayyad Square',
                'ContactNumber' => '+963991234567',
                'Email' => 'ahmed.interior@gov.sy',
                'password' => 'manager123',
                'email_verified_at' => now(),
            ],
            [
                'FirstnameAr' => 'فاطمة',
                'FirstnameEn' => 'Fatima',
                'LastnameAr' => 'السعد',
                'LastnameEn' => 'Al-Saad',
                'MiddlenameAr' => 'علي',
                'MiddlenameEn' => 'Ali',
                'BirthPlaceAr' => 'حلب',
                'BirthPlaceEn' => 'Aleppo',
                'BirthDate' => '1978-07-22',
                'NationalNumber' => '1978072298765',
                'IdFrontFace' => 'users/id_cards/2025/11/front_270b5c19-a8a9-40d6-a54e-ae3ebbf9cc47.png',
                'IdBackFace' => 'users/id_cards/2025/11/back_270b5c19-a8a9-40d6-a54e-ae3ebbf9cc47.png',
                'CurrentLocationAr' => 'دمشق - المزة',
                'CurrentLocationEn' => 'Damascus - Mazzeh',
                'ContactNumber' => '+963992345678',
                'Email' => 'fatima.education@gov.sy',
                'password' => 'manager123',
                'email_verified_at' => now(),
            ],
            [
                'FirstnameAr' => 'علي',
                'FirstnameEn' => 'Ali',
                'LastnameAr' => 'الحسن',
                'LastnameEn' => 'Al-Hassan',
                'MiddlenameAr' => 'يوسف',
                'MiddlenameEn' => 'Youssef',
                'BirthPlaceAr' => 'حمص',
                'BirthPlaceEn' => 'Homs',
                'BirthDate' => '1972-11-10',
                'NationalNumber' => '1972111045678',
                'IdFrontFace' => 'users/id_cards/2025/11/front_270b5c19-a8a9-40d6-a54e-ae3ebbf9cc47.png',
                'IdBackFace' => 'users/id_cards/2025/11/back_270b5c19-a8a9-40d6-a54e-ae3ebbf9cc47.png',
                'CurrentLocationAr' => 'دمشق - المالكي',
                'CurrentLocationEn' => 'Damascus - Malki',
                'ContactNumber' => '+963993456789',
                'Email' => 'mohammed.health@gov.sy',
                'password' => 'manager123',
                'email_verified_at' => now(),
            ],
            [
                'FirstnameAr' => 'سارة',
                'FirstnameEn' => 'Sara',
                'LastnameAr' => 'الحسن',
                'LastnameEn' => 'Al-Hassan',
                'MiddlenameAr' => 'أحمد',
                'MiddlenameEn' => 'Ahmed',
                'BirthPlaceAr' => 'اللاذقية',
                'BirthPlaceEn' => 'Latakia',
                'BirthDate' => '1980-05-18',
                'NationalNumber' => '1980051823456',
                'IdFrontFace' => 'users/id_cards/2025/11/front_270b5c19-a8a9-40d6-a54e-ae3ebbf9cc47.png',
                'IdBackFace' => 'users/id_cards/2025/11/back_270b5c19-a8a9-40d6-a54e-ae3ebbf9cc47.png',
                'CurrentLocationAr' => 'دمشق - باب توما',
                'CurrentLocationEn' => 'Damascus - Bab Touma',
                'ContactNumber' => '+963994567890',
                'Email' => 'sara.passport@gov.sy',
                'password' => 'manager123',
                'email_verified_at' => now(),
            ],
        ];

        DB::transaction(function () use ($managers) {
            $managerIds = [];
            foreach ($managers as $manager) {
                $user = $this->userRepo->create($manager);
                $this->userRepo->assignRole($user, 'agencyManager');
                $managerIds[] = $user->id;
            }

            $agencies = [
                [
                    'NameAr' => 'وزارة الداخلية',
                    'NameEn' => 'Ministry of Interior',
                    'DescriptionAr' => 'وزارة مسؤولة عن الأمن الداخلي والشؤون المدنية',
                    'DescriptionEn' => 'Ministry responsible for internal security and civil affairs',
                    'LocationAr' => 'دمشق - ساحة الأمويين',
                    'LocationEn' => 'Damascus - Umayyad Square',
                    'WorkingStartTime' => '08:00:00',
                    'WorkingEndTime' => '15:00:00',
                    'Status' => true,
                    'ParentId' => null,
                    'ManagerId' => $managerIds[0],
                ],
                [
                    'NameAr' => 'وزارة التربية',
                    'NameEn' => 'Ministry of Education',
                    'DescriptionAr' => 'وزارة مسؤولة عن التعليم والتربية في البلاد',
                    'DescriptionEn' => 'Ministry responsible for education and learning in the country',
                    'LocationAr' => 'دمشق - المزة',
                    'LocationEn' => 'Damascus - Mazzeh',
                    'WorkingStartTime' => '08:00:00',
                    'WorkingEndTime' => '15:00:00',
                    'Status' => true,
                    'ParentId' => null,
                    'ManagerId' => $managerIds[1],
                ],
                [
                    'NameAr' => 'وزارة الصحة',
                    'NameEn' => 'Ministry of Health',
                    'DescriptionAr' => 'وزارة مسؤولة عن الخدمات الصحية والطبية',
                    'DescriptionEn' => 'Ministry responsible for health and medical services',
                    'LocationAr' => 'دمشق - المالكي',
                    'LocationEn' => 'Damascus - Malki',
                    'WorkingStartTime' => '08:00:00',
                    'WorkingEndTime' => '15:00:00',
                    'Status' => true,
                    'ParentId' => null,
                    'ManagerId' => $managerIds[2],
                ],
            ];

            $agencyIds = [];
            foreach ($agencies as $agency) {
                $createdAgency = $this->governmentAgencyRepo->create($agency);
                $agencyIds[] = $createdAgency->id;
            }

            $subAgency = [
                'NameAr' => 'مديرية الجوازات والهجرة',
                'NameEn' => 'Directorate of Passports and Immigration',
                'DescriptionAr' => 'مديرية تابعة لوزارة الداخلية تختص بشؤون الجوازات والهجرة',
                'DescriptionEn' => 'Directorate under Ministry of Interior specializing in passport and immigration affairs',
                'LocationAr' => 'دمشق - باب توما',
                'LocationEn' => 'Damascus - Bab Touma',
                'WorkingStartTime' => '08:00:00',
                'WorkingEndTime' => '14:00:00',
                'Status' => true,
                'ParentId' => $agencyIds[0],
                'ManagerId' => $managerIds[3],
            ];

            $this->governmentAgencyRepo->create($subAgency);
        });
    }
}
