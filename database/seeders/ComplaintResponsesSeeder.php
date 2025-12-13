<?php

namespace Database\Seeders;

use App\Repositories\Contracts\ComplaintResponseRepositoryInterface;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComplaintResponsesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function __construct(
        private ComplaintResponseRepositoryInterface $complaintResponseRepo,
    ) {}

    public function run(): void
    {
        $complaint_responses = [
            [
                'Response' => 'شكراً لتواصلكم معنا. تم استلام طلبكم وسيتم مراجعته خلال 3 أيام عمل.',
                'EmployeeId' => 1,
                'UserId' => 1,
                'ComplaintId' => 1,
                'ParentId' => null,
            ],
            [
                'Response' => 'تم مراجعة طلبكم وسيتم إصدار الجواز خلال أسبوع. نعتذر عن التأخير.',
                'EmployeeId' => 1,
                'UserId' => 1,
                'ComplaintId' => 1,
                'ParentId' => 1,
            ],
            [
                'Response' => 'بخصوص تسجيل الطالب، يرجى إحضار شهادة الميلاد وصورة عن الهوية الشخصية للولي.',
                'EmployeeId' => 1,
                'UserId' => 1,
                'ComplaintId' => 2,
                'ParentId' => null,
            ],
            [
                'Response' => 'تم اتخاذ الإجراءات اللازمة لتحسين أوقات استجابة خدمة الإسعاف. شكراً لملاحظتكم.',
                'EmployeeId' => 1,
                'UserId' => 1,
                'ComplaintId' => 3,
                'ParentId' => null,
            ],
            [
                'Response' => 'اقتراحكم ممتاز وسيتم دراسته من قبل الفريق التقني. شكراً لاهتمامكم بتطوير الخدمات.',
                'EmployeeId' => 1,
                'UserId' => 1,
                'ComplaintId' => 4,
                'ParentId' => null,
            ],
        ];

        DB::transaction(function () use ($complaint_responses) {
            foreach ($complaint_responses as $response) {
                $this->complaintResponseRepo->create($response);
            }
        });
    }
}
