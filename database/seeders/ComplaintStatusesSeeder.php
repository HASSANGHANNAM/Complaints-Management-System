<?php

namespace Database\Seeders;

use App\Repositories\Contracts\ComplaintStatusRepositoryInterface;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComplaintStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function __construct(
        private ComplaintStatusRepositoryInterface $complaintStatusRepo,
    ) {}

    public function run(): void
    {
        $complaint_statuses = [
            [
                'Status' => 'جديدة',
                'ComplaintId' => 1,
            ],
            [
                'Status' => 'جديدة',
                'ComplaintId' => 1,
            ],
            [
                'Status' => 'جديدة',
                'ComplaintId' => 2,
            ],
            [
                'Status' => 'جديدة',
                'ComplaintId' => 3,
            ],
            [
                'Status' => 'جديدة',
                'ComplaintId' => 3,
            ],
            [
                'Status' => 'جديدة',
                'ComplaintId' => 3,
            ],
            [
                'Status' => 'جديدة',
                'ComplaintId' => 4,
            ],
        ];

        DB::transaction(function () use ($complaint_statuses) {
            foreach ($complaint_statuses as $status) {
                $this->complaintStatusRepo->create($status);
            }
        });
    }
}
