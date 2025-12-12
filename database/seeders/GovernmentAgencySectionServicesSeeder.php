<?php

namespace Database\Seeders;

use App\Repositories\Contracts\GovernmentAgencySectionServiceRepositoryInterface;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GovernmentAgencySectionServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function __construct(
        private GovernmentAgencySectionServiceRepositoryInterface $governmentAgencySectionServiceRepo,
    ) {}

    public function run(): void
    {
        $section_services = [
            [
                'NameAr' => 'تقديم شكوى',
                'NameEn' => 'Submit Complaint',
                'DescriptionAr' => 'خدمة تقديم الشكاوى والتظلمات',
                'DescriptionEn' => 'Service for submitting complaints and grievances',
                'SectionId' => 1,
            ],
            [
                'NameAr' => 'تقديم اقتراح',
                'NameEn' => 'Submit Suggestion',
                'DescriptionAr' => 'خدمة تقديم الاقتراحات والأفكار التطويرية',
                'DescriptionEn' => 'Service for submitting suggestions and development ideas',
                'SectionId' => 1,
            ],
            [
                'NameAr' => 'استخراج بيان قيد',
                'NameEn' => 'Extract Registration Statement',
                'DescriptionAr' => 'خدمة استخراج بيان قيد مدني',
                'DescriptionEn' => 'Service for extracting civil registration statement',
                'SectionId' => 2,
            ],
            [
                'NameAr' => 'تسجيل طالب جديد',
                'NameEn' => 'Register New Student',
                'DescriptionAr' => 'خدمة تسجيل الطلاب الجدد في المدارس',
                'DescriptionEn' => 'Service for registering new students in schools',
                'SectionId' => 3,
            ],
            [
                'NameAr' => 'نقل طالب',
                'NameEn' => 'Transfer Student',
                'DescriptionAr' => 'خدمة نقل الطلاب بين المدارس',
                'DescriptionEn' => 'Service for transferring students between schools',
                'SectionId' => 3,
            ],
            [
                'NameAr' => 'طلب إسعاف',
                'NameEn' => 'Request Ambulance',
                'DescriptionAr' => 'خدمة طلب الإسعاف في الحالات الطارئة',
                'DescriptionEn' => 'Service for requesting ambulance in emergency cases',
                'SectionId' => 5,
            ],
            [
                'NameAr' => 'إصدار جواز سفر جديد',
                'NameEn' => 'Issue New Passport',
                'DescriptionAr' => 'خدمة إصدار جواز سفر جديد للمواطنين',
                'DescriptionEn' => 'Service for issuing new passport for citizens',
                'SectionId' => 6,
            ],
            [
                'NameAr' => 'تجديد جواز السفر',
                'NameEn' => 'Renew Passport',
                'DescriptionAr' => 'خدمة تجديد جواز السفر المنتهي الصلاحية',
                'DescriptionEn' => 'Service for renewing expired passport',
                'SectionId' => 6,
            ],
        ];

        DB::transaction(function () use ($section_services) {
            foreach ($section_services as $service) {
                $this->governmentAgencySectionServiceRepo->create($service);
            }
        });
    }
}

