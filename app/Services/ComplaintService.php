<?php

namespace App\Services;

use App\Repositories\Contracts\ComplaintRepositoryInterface;
use App\Repositories\Contracts\ComplaintStatusRepositoryInterface;
use App\Repositories\Contracts\MediaRepositoryInterface;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\UploadedFile;

class ComplaintService
{
    public function __construct(
        private ComplaintRepositoryInterface $complaintRepo,
        private ComplaintStatusRepositoryInterface $complaintStatusRepo,
        private MediaRepositoryInterface $mediaRepo
    ) {}

    public function createComplaint($request)
    {
        return DB::transaction(function () use ($request) {

            // Create the complaint
            $complaint = $this->complaintRepo->create($request);

            // Create initial status for the complaint (use enum default 'جديدة')
            $complaintStatus = $this->complaintStatusRepo->create([
                'Status' => 'جديدة',
                'ComplaintId' => $complaint->id,
            ]);

            // If the request included uploaded files under key `media`, store them
            // using the same convention as ID images: dated folder + uuid filename
            $files = $request['media'] ?? null;
            if ($files && is_array($files)) {
                foreach ($files as $file) {
                    if ($file instanceof UploadedFile && $file->isValid()) {
                        $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
                        $folder = 'complaints/' . date('Y/m');
                        $fullPath = $folder . '/' . $fileName;

                        // Store in the same private disk used for ID files
                        Storage::disk('secure_documents')->put(
                            $fullPath,
                            file_get_contents($file->getRealPath())
                        );

                        // Persist media record (store only path + ComplaintId as requested)
                        $this->mediaRepo->create([
                            'Media' => $fullPath,
                            'ComplaintId' => $complaint->id,
                        ]);
                    }
                }
            }

            $data = [];
            $code = 200;
            $message = 'Complaint created successfully!';
            return ['data' => $data, 'message' => $message, 'code' => $code];
        });
    }

    public function getComplaintById($id)
    {
        //  جلب تفاصيل شكوى محددة
    }

    public function getUserComplaints($request)
    {
        $data = $this->complaintRepo->getUserComplaints($request);
        $code = 200;
        $message = 'User complaints retrieved successfully!';
        return ['data' => $data, 'message' => $message, 'code' => $code];
    }
    public function getComplaintDetails($id)
    {
        $data = $this->complaintRepo->getComplaintDetails($id);
        $code = 200;
        $message = 'User Complaint details retrieved successfully!';
        return ['data' => $data, 'message' => $message, 'code' => $code];
    }

    public function addAttachment($request, $complaintId)
    {
        //  رفع الملفات وربطها بالشكوى
    }

    public function getComplaintTracking($complaintId)
    {
        //  جلب التحديثات والحالة الزمنية للشكوى
    }
}
