<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateComplaintStatusRequest;
use App\Http\Requests\Admin\AddAdminNoteRequest;
use App\Services\AdminComplaintService;
use App\Http\Responses\Response;
use Illuminate\Http\JsonResponse;
use Throwable;

class AdminComplaintController extends Controller
{
    private AdminComplaintService $adminComplaintService;

    public function __construct(AdminComplaintService $adminComplaintService)
    {
        $this->adminComplaintService = $adminComplaintService;
    }

    public function getAllComplaints(): JsonResponse
    {
        try {
            $data = $this->adminComplaintService->getAllComplaints();
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            return Response::Error([], $th->getMessage());
        }
    }

    public function updateStatus(UpdateComplaintStatusRequest $request, $id): JsonResponse
    {
        try {
            $data = $this->adminComplaintService->updateStatus($request->validated(), $id);
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            return Response::Error([], $th->getMessage());
        }
    }

    public function addNote(AddAdminNoteRequest $request, $id): JsonResponse
    {
        try {
            $data = $this->adminComplaintService->addNote($request->validated(), $id);
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            return Response::Error([], $th->getMessage());
        }
    }
}
