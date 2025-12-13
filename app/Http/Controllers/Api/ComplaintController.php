<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Complaints\CreateComplaintRequest;
use App\Http\Requests\Complaints\AddAttachmentRequest;
use App\Http\Requests\Complaints\CreateResponseRequest;
use App\Http\Requests\Complaints\CreateUserResponseRequest;
use App\Http\Requests\MyComplaintsRequest;

use App\Services\ComplaintService;
use App\Http\Responses\Response;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
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
            $validated = $request->validated();
            $validated['media'] = $request->file('media') ?? [];
            $data = $this->complaintService->createComplaint($validated);
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

    public function myComplaints(MyComplaintsRequest $request): JsonResponse
    {
        try {
            $data = $this->complaintService->getUserComplaints($request->validated());
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            return Response::Error([], $th->getMessage());
        }
    }
    public function getComplaintDetails($id): JsonResponse
    {
        try {
            $data = $this->complaintService->getComplaintDetails($id);
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
    public function getComplaintRespons($id): JsonResponse
    {
        try {
            $data = $this->complaintService->getComplaintRespons($id);
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            return Response::Error([], $th->getMessage());
        }
    }
    public function createComplaintRespons(CreateResponseRequest $request): JsonResponse
    {
        try {
            $data = $this->complaintService->createComplaintRespons($request->validated());
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            return Response::Error([], $th->getMessage());
        }
    }
    public function createRespons(CreateUserResponseRequest $request): JsonResponse
    {
        try {
            $data = $this->complaintService->createComplaintRespons($request->validated());
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            return Response::Error([], $th->getMessage());
        }
    }
    public function getTracing($id): JsonResponse
    {
        try {
            $data = $this->complaintService->getTracing($id);
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            return Response::Error([], $th->getMessage());
        }
    }
}
