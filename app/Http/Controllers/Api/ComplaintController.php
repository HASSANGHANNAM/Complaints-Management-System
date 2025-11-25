<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Complaints\CreateComplaintRequest;
use App\Http\Requests\Complaints\AddAttachmentRequest;
use App\Services\ComplaintService;
use App\Http\Responses\Response;
use Illuminate\Http\JsonResponse;
use Throwable;

class ComplaintController extends Controller
{
    private ComplaintService $complaintService;

    public function __construct(ComplaintService $complaintService)
    {
        $this->complaintService = $complaintService;
    }

    public function createComplaint(CreateComplaintRequest $request): JsonResponse
    {
        try {
            $data = $this->complaintService->createComplaint($request->validated());
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            return Response::Error([], $th->getMessage());
        }
    }

    public function getComplaint($id): JsonResponse
    {
        try {
            $data = $this->complaintService->getComplaintById($id);
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            return Response::Error([], $th->getMessage());
        }
    }

    public function myComplaints(): JsonResponse
    {
        try {
            $data = $this->complaintService->getUserComplaints(auth()->id());
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            return Response::Error([], $th->getMessage());
        }
    }

    public function addAttachment(AddAttachmentRequest $request, $id): JsonResponse
    {
        try {
            $data = $this->complaintService->addAttachment($request->validated(), $id);
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            return Response::Error([], $th->getMessage());
        }
    }

    public function ComplaintTracking($id): JsonResponse
    {
        try {
            $data = $this->complaintService->getComplaintTracking($id);
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            return Response::Error([], $th->getMessage());
        }
    }
}
