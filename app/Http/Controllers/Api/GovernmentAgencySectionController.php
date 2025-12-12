<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSectionRequest;
use App\Http\Requests\UpdateSectionRequest;
use App\Services\GovernmentAgencySectionService;
use App\Http\Responses\Response;
use Illuminate\Http\JsonResponse;
use Throwable;

class GovernmentAgencySectionController extends Controller
{
    public function __construct(
        private GovernmentAgencySectionService $service
    ) {}

    public function create(CreateSectionRequest $request): JsonResponse
    {
        try {
            $data = $this->service->createSection($request->validated());
            return Response::success($data['data'], $data['message'], $data['code']);

        } catch (Throwable $e) {
            return Response::Error([], $e->getMessage());
        }
    }

    public function update(UpdateSectionRequest $request, int $id): JsonResponse
    {
        try {
            $data = $this->service->updateSection($id, $request->validated());
            return Response::success($data['data'], $data['message'], $data['code']);

        } catch (Throwable $e) {
            return Response::Error([], $e->getMessage());
        }
    }

    public function delete(int $id): JsonResponse
    {
        try {
            $data = $this->service->deleteSection($id);
            return Response::success($data['data'], $data['message'], $data['code']);

        } catch (Throwable $e) {
            return Response::Error([], $e->getMessage());
        }
    }

    public function get(int $id): JsonResponse
    {
        try {
            $data = $this->service->getSection($id);
            return Response::success($data['data'], $data['message'], $data['code']);

        } catch (Throwable $e) {
            return Response::Error([], $e->getMessage());
        }
    }

    public function list(): JsonResponse
    {
        try {
            $data = $this->service->listSections();
            return Response::success($data['data'], $data['message'], $data['code']);

        } catch (Throwable $e) {
            return Response::Error([], $e->getMessage());
        }
    }
}
