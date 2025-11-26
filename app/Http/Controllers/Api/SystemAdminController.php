<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\SystemAdminService;
use App\Http\Requests\Admin\CreateAgencyRequest;
use App\Http\Requests\Admin\CreateUserRequest;
use App\Http\Responses\Response;
use Illuminate\Http\JsonResponse;
use Throwable;

class SystemAdminController extends Controller
{
    private SystemAdminService $systemAdminService;

    public function __construct(SystemAdminService $systemAdminService)
    {
        $this->systemAdminService = $systemAdminService;
    }

    public function SystemStats(): JsonResponse
    {
        try {
            $data = $this->systemAdminService->getSystemStats();
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            return Response::Error([], $th->getMessage());
        }
    }

    public function exportData(): JsonResponse
    {
        try {
            $data = $this->systemAdminService->exportData([]);
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            return Response::Error([], $th->getMessage());
        }
    }

    public function manageAgencies(CreateAgencyRequest $request): JsonResponse
    {
        try {
            $data = $this->systemAdminService->manageAgencies($request->validated());
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            return Response::Error([], $th->getMessage());
        }
    }

    public function createUser(CreateUserRequest $request): JsonResponse
    {
        try {
            $data = $this->systemAdminService->manageUsers($request->validated());
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            return Response::Error([], $th->getMessage());
        }
    }
}
