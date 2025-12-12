<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateComplaintStatusRequest;
use App\Services\ComplaintStatusService;
use App\Http\Responses\Response;
use Illuminate\Http\JsonResponse;
use Throwable;

class ComplaintStatusController extends Controller
{
    public function __construct(private ComplaintStatusService $service) {}

    public function updateStatus(UpdateComplaintStatusRequest $request, int $id): JsonResponse
    {
        try {
            $data = $this->service->updateComplaintStatus($id, $request->validated());
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $e) {
            return Response::Error([], $e->getMessage());
        }
    }
}
