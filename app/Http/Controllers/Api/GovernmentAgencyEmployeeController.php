<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\GovernmentAgencyEmployeeService;
use App\Http\Requests\CreateEmployeeRequest;
use App\Http\Requests\GetEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Http\Responses\Response;
use Illuminate\Http\JsonResponse;
use Throwable;

class GovernmentAgencyEmployeeController extends Controller
{
    public function __construct(private GovernmentAgencyEmployeeService $employeeService) {}

    public function createEmployee(CreateEmployeeRequest $request): JsonResponse
    {
        try {
            $data = $this->employeeService->createEmployee($request->validated());
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            return Response::Error([], $th->getMessage());
        }
    }

    public function updateEmployee(UpdateEmployeeRequest $request, $id): JsonResponse
    {
        try {
            $data = $this->employeeService->updateEmployee($id, $request->validated());
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            return Response::Error([], $th->getMessage());
        }
    }

    public function deleteEmployee($id): JsonResponse
    {
        try {
            $data = $this->employeeService->deleteEmployee($id);
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            return Response::Error([], $th->getMessage());
        }
    }

    public function getEmployee($id): JsonResponse
    {
        try {
            $data = $this->employeeService->getEmployee($id);
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            return Response::Error([], $th->getMessage());
        }
    }

    public function listEmployees(GetEmployeeRequest $request): JsonResponse
    {
        try {
            $data = $this->employeeService->listEmployees($request->validated());
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            return Response::Error([], $th->getMessage());
        }
    }
}
