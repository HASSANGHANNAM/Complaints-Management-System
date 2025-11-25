<?php

namespace Database\Seeders;

use App\Repositories\Contracts\GovernmentAgencyEmployeeRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class GovernmentAgencyEmployeesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function __construct(
        private GovernmentAgencyEmployeeRepositoryInterface $governmentAgencyEmployeeRepo,
        private UserRepositoryInterface $userRepo,
    ) {}

    public function run(): void
    {
        $employees = [
            [
                'FirstnameAr' => 'خالد',
                'FirstnameEn' => 'Khaled',
                'LastnameAr' => 'العلي',
                'LastnameEn' => 'Al-Ali',
                'MiddlenameAr' => 'أحمد',
                'MiddlenameEn' => 'Ahmed',
                'BirthPlaceAr' => 'دمشق',
                'BirthPlaceEn' => 'Damascus',
                'BirthDate' => '1985-04-12',
                'NationalNumber' => '1985041298765',
                'IdFrontFace' => 'users/id_cards/2025/11/front_5080fa7d-1d0b-42fa-b548-a5087842997d.png',
                'IdBackFace' => 'users/id_cards/2025/11/back_5080fa7d-1d0b-42fa-b548-a5087842997d.png',
                'CurrentLocationAr' => 'دمشق - ساحة الأمويين',
                'CurrentLocationEn' => 'Damascus - Umayyad Square',
                'ContactNumber' => '+963995123456',
                'Email' => 'khaled.interior@gov.sy',
                'password' => Hash::make('employee123'),
                'email_verified_at' => now(),
            ],
            [
                'FirstnameAr' => 'نور',
                'FirstnameEn' => 'Nour',
                'LastnameAr' => 'الشام',
                'LastnameEn' => 'Al-Sham',
                'MiddlenameAr' => 'محمد',
                'MiddlenameEn' => 'Mohammed',
                'BirthPlaceAr' => 'حلب',
                'BirthPlaceEn' => 'Aleppo',
                'BirthDate' => '1988-08-25',
                'NationalNumber' => '1988082534567',
                'IdFrontFace' => 'users/id_cards/2025/11/front_nour.png',
                'IdBackFace' => 'users/id_cards/2025/11/back_nour.png',
                'CurrentLocationAr' => 'دمشق - ساحة الأمويين',
                'CurrentLocationEn' => 'Damascus - Umayyad Square',
                'ContactNumber' => '+963996234567',
                'Email' => 'nour.interior@gov.sy',
                'password' => Hash::make('employee123'),
                'email_verified_at' => now(),
            ],
            [
                'FirstnameAr' => 'ليلى',
                'FirstnameEn' => 'Layla',
                'LastnameAr' => 'الحكيم',
                'LastnameEn' => 'Al-Hakim',
                'MiddlenameAr' => 'يوسف',
                'MiddlenameEn' => 'Youssef',
                'BirthPlaceAr' => 'دمشق',
                'BirthPlaceEn' => 'Damascus',
                'BirthDate' => '1986-12-03',
                'NationalNumber' => '1986120345678',
                'IdFrontFace' => 'users/id_cards/2025/11/front_layla.png',
                'IdBackFace' => 'users/id_cards/2025/11/back_layla.png',
                'CurrentLocationAr' => 'دمشق - المزة',
                'CurrentLocationEn' => 'Damascus - Mazzeh',
                'ContactNumber' => '+963997345678',
                'Email' => 'layla.education@gov.sy',
                'password' => Hash::make('employee123'),
                'email_verified_at' => now(),
            ],
            [
                'FirstnameAr' => 'عمر',
                'FirstnameEn' => 'Omar',
                'LastnameAr' => 'الدين',
                'LastnameEn' => 'Al-Din',
                'MiddlenameAr' => 'صلاح',
                'MiddlenameEn' => 'Salah',
                'BirthPlaceAr' => 'حمص',
                'BirthPlaceEn' => 'Homs',
                'BirthDate' => '1984-06-18',
                'NationalNumber' => '1984061823456',
                'IdFrontFace' => 'users/id_cards/2025/11/front_omar.png',
                'IdBackFace' => 'users/id_cards/2025/11/back_omar.png',
                'CurrentLocationAr' => 'دمشق - المزة',
                'CurrentLocationEn' => 'Damascus - Mazzeh',
                'ContactNumber' => '+963998456789',
                'Email' => 'omar.education@gov.sy',
                'password' => Hash::make('employee123'),
                'email_verified_at' => now(),
            ],
            [
                'FirstnameAr' => 'رانيا',
                'FirstnameEn' => 'Rania',
                'LastnameAr' => 'الطبيب',
                'LastnameEn' => 'Al-Tabib',
                'MiddlenameAr' => 'علي',
                'MiddlenameEn' => 'Ali',
                'BirthPlaceAr' => 'اللاذقية',
                'BirthPlaceEn' => 'Latakia',
                'BirthDate' => '1987-09-14',
                'NationalNumber' => '1987091434567',
                'IdFrontFace' => 'users/id_cards/2025/11/front_rania.png',
                'IdBackFace' => 'users/id_cards/2025/11/back_rania.png',
                'CurrentLocationAr' => 'دمشق - المالكي',
                'CurrentLocationEn' => 'Damascus - Malki',
                'ContactNumber' => '+963999567890',
                'Email' => 'rania.health@gov.sy',
                'password' => Hash::make('employee123'),
                'email_verified_at' => now(),
            ],
            [
                'FirstnameAr' => 'يوسف',
                'FirstnameEn' => 'Youssef',
                'LastnameAr' => 'الصحة',
                'LastnameEn' => 'Al-Saha',
                'MiddlenameAr' => 'محمود',
                'MiddlenameEn' => 'Mahmoud',
                'BirthPlaceAr' => 'طرطوس',
                'BirthPlaceEn' => 'Tartous',
                'BirthDate' => '1983-11-27',
                'NationalNumber' => '1983112745678',
                'IdFrontFace' => 'users/id_cards/2025/11/front_youssef.png',
                'IdBackFace' => 'users/id_cards/2025/11/back_youssef.png',
                'CurrentLocationAr' => 'دمشق - المالكي',
                'CurrentLocationEn' => 'Damascus - Malki',
                'ContactNumber' => '+963990678901',
                'Email' => 'youssef.health@gov.sy',
                'password' => Hash::make('employee123'),
                'email_verified_at' => now(),
            ],
            [
                'FirstnameAr' => 'مريم',
                'FirstnameEn' => 'Mariam',
                'LastnameAr' => 'الجواز',
                'LastnameEn' => 'Al-Jawaz',
                'MiddlenameAr' => 'خالد',
                'MiddlenameEn' => 'Khaled',
                'BirthPlaceAr' => 'دير الزور',
                'BirthPlaceEn' => 'Deir Ezzor',
                'BirthDate' => '1989-02-08',
                'NationalNumber' => '1989020856789',
                'IdFrontFace' => 'users/id_cards/2025/11/front_mariam.png',
                'IdBackFace' => 'users/id_cards/2025/11/back_mariam.png',
                'CurrentLocationAr' => 'دمشق - باب توما',
                'CurrentLocationEn' => 'Damascus - Bab Touma',
                'ContactNumber' => '+963991789012',
                'Email' => 'mariam.passport@gov.sy',
                'password' => Hash::make('employee123'),
                'email_verified_at' => now(),
            ],
            [
                'FirstnameAr' => 'حسام',
                'FirstnameEn' => 'Hussam',
                'LastnameAr' => 'الوثائق',
                'LastnameEn' => 'Al-Wathaeq',
                'MiddlenameAr' => 'فادي',
                'MiddlenameEn' => 'Fadi',
                'BirthPlaceAr' => 'السويداء',
                'BirthPlaceEn' => 'Sweida',
                'BirthDate' => '1986-05-22',
                'NationalNumber' => '1986052267890',
                'IdFrontFace' => 'users/id_cards/2025/11/front_hussam.png',
                'IdBackFace' => 'users/id_cards/2025/11/back_hussam.png',
                'CurrentLocationAr' => 'دمشق - باب توما',
                'CurrentLocationEn' => 'Damascus - Bab Touma',
                'ContactNumber' => '+963992890123',
                'Email' => 'hussam.passport@gov.sy',
                'password' => Hash::make('employee123'),
                'email_verified_at' => now(),
            ],
        ];

        DB::transaction(function () use ($employees) {
            $employeeIds = [];
            foreach ($employees as $employee) {
                $user = $this->userRepo->create($employee);
                $this->userRepo->assignRole($user, 'employee');
                $employeeIds[] = $user->id;
            }

            $agency_employees = [
                [
                    'EmploymentStatus' => true,
                    'EmploymentDate' => '2020-01-15',
                    'CanResponseToComplaint' => true,
                    'CanChangeComplaintStatus' => true,
                    'UserId' => $employeeIds[0],
                    'EmploymentTypeId' => 1,
                ],
                [
                    'EmploymentStatus' => true,
                    'EmploymentDate' => '2021-03-10',
                    'CanResponseToComplaint' => true,
                    'CanChangeComplaintStatus' => false,
                    'UserId' => $employeeIds[1],
                    'EmploymentTypeId' => 1,
                ],
                [
                    'EmploymentStatus' => true,
                    'EmploymentDate' => '2020-06-01',
                    'CanResponseToComplaint' => true,
                    'CanChangeComplaintStatus' => true,
                    'UserId' => $employeeIds[2],
                    'EmploymentTypeId' => 1,
                ],
                [
                    'EmploymentStatus' => true,
                    'EmploymentDate' => '2021-09-15',
                    'CanResponseToComplaint' => true,
                    'CanChangeComplaintStatus' => false,
                    'UserId' => $employeeIds[3],
                    'EmploymentTypeId' => 1,
                ],
                [
                    'EmploymentStatus' => true,
                    'EmploymentDate' => '2019-11-20',
                    'CanResponseToComplaint' => true,
                    'CanChangeComplaintStatus' => true,
                    'UserId' => $employeeIds[4],
                    'EmploymentTypeId' => 1,
                ],
                [
                    'EmploymentStatus' => true,
                    'EmploymentDate' => '2022-02-10',
                    'CanResponseToComplaint' => true,
                    'CanChangeComplaintStatus' => false,
                    'UserId' => $employeeIds[5],
                    'EmploymentTypeId' => 1,
                ],
                [
                    'EmploymentStatus' => true,
                    'EmploymentDate' => '2020-08-05',
                    'CanResponseToComplaint' => true,
                    'CanChangeComplaintStatus' => true,
                    'UserId' => $employeeIds[6],
                    'EmploymentTypeId' => 1,
                ],
                [
                    'EmploymentStatus' => true,
                    'EmploymentDate' => '2021-12-12',
                    'CanResponseToComplaint' => true,
                    'CanChangeComplaintStatus' => false,
                    'UserId' => $employeeIds[7],
                    'EmploymentTypeId' => 1,
                ],
            ];

            foreach ($agency_employees as $employee) {
                $this->governmentAgencyEmployeeRepo->create($employee);
            }
        });
    }
}
