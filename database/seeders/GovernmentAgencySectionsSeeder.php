<?php

namespace Database\Seeders;

use App\Repositories\Contracts\GovernmentAgencySectionRepositoryInterface;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GovernmentAgencySectionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function __construct(
        private GovernmentAgencySectionRepositoryInterface $governmentAgencySectionRepo,
    ) {}

    public function run(): void
    {
        $agency_sections = [
            [
                'NameAr' => 'قسم الشكاوى والاقتراحات',
                'NameEn' => 'Complaints and Suggestions Department',
                'DescriptionAr' => 'قسم مختص بتلقي ومعالجة الشكاوى والاقتراحات من المواطنين',
                'DescriptionEn' => 'Department specialized in receiving and processing complaints and suggestions from citizens',
                'AgencyId' => 1,
            ],
            [
                'NameAr' => 'قسم الخدمات المدنية',
                'NameEn' => 'Civil Services Department',
                'DescriptionAr' => 'قسم يقدم الخدمات المدنية للمواطنين',
                'DescriptionEn' => 'Department providing civil services to citizens',
                'AgencyId' => 1,
            ],
            [
                'NameAr' => 'قسم شؤون الطلاب',
                'NameEn' => 'Student Affairs Department',
                'DescriptionAr' => 'قسم مختص بشؤون الطلاب والتعليم',
                'DescriptionEn' => 'Department specialized in student affairs and education',
                'AgencyId' => 2,
            ],
            [
                'NameAr' => 'قسم المناهج والتطوير',
                'NameEn' => 'Curriculum and Development Department',
                'DescriptionAr' => 'قسم مسؤول عن تطوير المناهج التعليمية',
                'DescriptionEn' => 'Department responsible for developing educational curricula',
                'AgencyId' => 2,
            ],
            [
                'NameAr' => 'قسم الطوارئ الطبية',
                'NameEn' => 'Medical Emergency Department',
                'DescriptionAr' => 'قسم مختص بالطوارئ والحالات الطبية العاجلة',
                'DescriptionEn' => 'Department specialized in emergency and urgent medical cases',
                'AgencyId' => 3,
            ],
            [
                'NameAr' => 'قسم إصدار الجوازات',
                'NameEn' => 'Passport Issuance Department',
                'DescriptionAr' => 'قسم مختص بإصدار وتجديد الجوازات',
                'DescriptionEn' => 'Department specialized in issuing and renewing passports',
                'AgencyId' => 4,
            ],
        ];

        DB::transaction(function () use ($agency_sections) {
            foreach ($agency_sections as $section) {
                $this->governmentAgencySectionRepo->create($section);
            }
        });
    }
}

