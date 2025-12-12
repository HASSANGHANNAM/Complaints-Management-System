<?php

namespace App\Services;

use App\Repositories\Contracts\ComplaintRepositoryInterface;
use App\Repositories\Contracts\ComplaintStatusRepositoryInterface;

class ComplaintStatusService
{
    public function __construct(
        private ComplaintRepositoryInterface $complaintRepo,
        private ComplaintStatusRepositoryInterface $complaintStatusRepo
    ) {}

    public function updateComplaintStatus(int $complaintId, array $data): array
    {
        $complaint = $this->complaintRepo->findById($complaintId);
        if (!$complaint) {
            return [
                'data' => [],
                'message' => 'Complaint not found',
                'code' => 404
            ];
        }

        $employee = auth()->user()->employee;
        if (!$employee) {
            return [
                'data' => [],
                'message' => 'You are not a government agency employee',
                'code' => 403
            ];
        }

        if (!$employee->CanChangeComplaintStatus) {
            return [
                'data' => [],
                'message' => 'You do not have permission to change complaint status',
                'code' => 403
            ];
        }

        if ($complaint->EmployeeId && $complaint->EmployeeId !== $employee->UserId) {
            return [
                'data' => [],
                'message' => 'This complaint is assigned to another employee',
                'code' => 403
            ];
        }

        $complaintStatus = $this->complaintStatusRepo->create([
            'Status' => $data['Status'],
            'ComplaintId' => $complaintId,
        ]);

        return [
            'data' => $complaintStatus,
            'message' => 'Complaint status updated successfully',
            'code' => 200
        ];
    }
}
