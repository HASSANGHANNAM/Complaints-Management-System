<?php

namespace Database\Seeders;

use App\Repositories\Contracts\MediaRepositoryInterface;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class MediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function __construct(
        private MediaRepositoryInterface $mediaRepo,
    ) {}

    public function run(): void
    {
        // Store fixed media paths (you will place the actual files manually).
        $media = [
            ['Media' => 'complaints/attachments/2025/11/passport_application_copy_0ac43fa6-7109-4644-92b9-8a3a2713ae85.pdf', 'ComplaintId' => 1],
            ['Media' => 'complaints/attachments/2025/11/student_documents_3b7e2a1f-2c44-4a9b-a2f1-1b2c3d4e5f60.pdf', 'ComplaintId' => 1],
            ['Media' => 'complaints/attachments/2025/11/emergency_report_9f8b7c6d-5e4f-3a2b-1c0d-9e8f7a6b5c4d.jpg', 'ComplaintId' => 2],
            ['Media' => 'complaints/attachments/2025/11/photo_scene_11111111-2222-3333-4444-555555555555.jpg', 'ComplaintId' => 2],
            ['Media' => 'complaints/attachments/2025/11/witness_statement_aaaaaaaa-bbbb-cccc-dddd-eeeeeeeeeeee.pdf', 'ComplaintId' => 3],
            ['Media' => 'complaints/attachments/2025/11/damage_photo_bb0bb0bb-0bb0-0bb0-bb0b-0bb0bb0bb0bb.jpg', 'ComplaintId' => 4],
            ['Media' => 'complaints/attachments/2025/11/identity_copy_cccccccc-dddd-eeee-ffff-000000000000.pdf', 'ComplaintId' => 4],
            ['Media' => 'complaints/attachments/2025/11/site_image_dddddddd-1111-2222-3333-444444444444.jpg', 'ComplaintId' => 4],
        ];

        DB::transaction(function () use ($media) {
            foreach ($media as $m) {
                $this->mediaRepo->create($m);
            }
        });
    }
}
