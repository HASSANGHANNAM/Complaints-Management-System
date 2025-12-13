<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSectionServiceRequest;
use App\Http\Requests\GetServicesRequest;
use App\Http\Requests\UpdateSectionServiceRequest;
use App\Services\GovernmentAgencySectionServiceService;
use App\Http\Responses\Response;
use Illuminate\Http\JsonResponse;
use Throwable;

class GovernmentAgencySectionServiceController extends Controller
{
    public function __construct(
        private GovernmentAgencySectionServiceService $service
    ) {}


    public function create(CreateSectionServiceRequest $request, int $sectionId): JsonResponse
    {
        try {
            $data = $this->service->createService($sectionId, $request->validated());
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $e) {
            return Response::Error([], $e->getMessage());
        }
    }

    public function update(UpdateSectionServiceRequest $request, int $id): JsonResponse
    {
        try {
            $data = $this->service->updateService($id, $request->validated());
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $e) {
            return Response::Error([], $e->getMessage());
        }
    }


    public function delete(int $id): JsonResponse
    {
        try {
            $data = $this->service->deleteService($id);
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $e) {
            return Response::Error([], $e->getMessage());
        }
    }


    public function find(int $id): JsonResponse
    {
        try {
            $data = $this->service->getService($id);
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $e) {
            return Response::Error([], $e->getMessage());
        }
    }
    public function getServices(GetServicesRequest $request, $id): JsonResponse
    {
        try {
            $data = $this->service->getServices($request->validated(), $id);
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message = $th->getMessage();
            return Response::Error([], $message);
        }
    }
    // public function list(): JsonResponse
    // {
    //     try {
    //         $data = $this->service->listServices();
    //         return Response::success($data['data'], $data['message'], $data['code']);
    //     } catch (Throwable $e) {
    //         return Response::Error([], $e->getMessage());
    //     }
    // }
}
