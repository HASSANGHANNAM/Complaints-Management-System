<?php

namespace Database\Seeders;

use App\Repositories\Contracts\ComplaintRepositoryInterface;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComplaintsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function __construct(
        private ComplaintRepositoryInterface $complaintRepo,
    ) {}

    public function run(): void
    {
        $complaints = [
            [
                'Title' => 'تأخير في إصدار الجواز',
                'Content' => 'تقدمت بطلب إصدار جواز سفر منذ شهرين ولم يتم الرد حتى الآن. أرجو المتابعة والإسراع في الإجراءات.',
                'EmployeeId' => null,
                'UserId' => 2,
                'AgencyId' => 4,
                'SectionId' => 6,
            ],
            [
                'Title' => 'مشكلة في تسجيل الطالب',
                'Content' => 'واجهت صعوبة في تسجيل ابني في المدرسة بسبب نقص في الأوراق المطلوبة. أرجو التوضيح حول الوثائق المطلوبة.',
                'EmployeeId' => null,
                'UserId' => 2,
                'AgencyId' => 2,
                'SectionId' => 3,
            ],
            [
                'Title' => 'تأخير في خدمة الإسعاف',
                'Content' => 'تم الاتصال بخدمة الإسعاف في حالة طارئة ولكن وصل الإسعاف متأخراً. أرجو تحسين أوقات الاستجابة.',
                'EmployeeId' => null,
                'UserId' => 2,
                'AgencyId' => 3,
                'SectionId' => 5,
            ],
            [
                'Title' => 'اقتراح تحسين الخدمة',
                'Content' => 'أقترح إضافة نظام حجز مواعيد إلكتروني لتسهيل الحصول على الخدمات وتقليل أوقات الانتظار.',
                'EmployeeId' => null,
                'UserId' => 2,
                'AgencyId' => 1,
                'SectionId' => 1,
            ],
        ];

        DB::transaction(function () use ($complaints) {
            foreach ($complaints as $complaint) {
                $this->complaintRepo->create($complaint);
            }
        });
    }
}
