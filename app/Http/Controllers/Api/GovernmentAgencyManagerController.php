<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAgencyManagerRequest;
use App\Services\GovernmentAgencyManagerService;
use App\Http\Responses\Response;
use Illuminate\Http\JsonResponse;
use Throwable;

class GovernmentAgencyManagerController extends Controller
{
    public function __construct(
        private GovernmentAgencyManagerService $service
    ) {}

    public function create(StoreAgencyManagerRequest $request,int $agencyId): JsonResponse
    {
        try {
            $data = $this->service->createManager($request->validated(), $agencyId);
            return Response::success($data['data'], $data['message'], $data['code']);

        } catch (Throwable $e) {
            return Response::Error([], $e->getMessage());
        }
    }
}
