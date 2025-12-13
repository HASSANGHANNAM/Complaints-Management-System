<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GovernmentAgency\StoreAgencyRequest;
use App\Http\Requests\GovernmentAgency\UpdateAgencyRequest;
use App\Http\Requests\GovernmentAgency\SearchAgencyRequest;
use App\Http\Requests\GetAgenciesRequest;
use App\Http\Requests\GetFullAgenciesRequest;
use App\Http\Requests\GetSectionsRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Http\Responses\Response;
use App\Services\GovernmentAgencyServices;
use Throwable;

class GovernmentAgencyController extends Controller
{
    private GovernmentAgencyServices $governmentAgencyServices;

    public function __construct(GovernmentAgencyServices $governmentAgencyServices)
    {
        $this->governmentAgencyServices = $governmentAgencyServices;
    }

    public function getAgencies(GetAgenciesRequest $request): JsonResponse
    {
        try {
            $data = $this->governmentAgencyServices->getAgencies($request->validated());
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message = $th->getMessage();
            return Response::Error([], $message);
        }
    }

    public function getSections(GetSectionsRequest $request, int $agencyId): JsonResponse
    {
        try {
            $data = $this->governmentAgencyServices->getSections($request->validated(), $agencyId);
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message = $th->getMessage();
            return Response::Error([], $message);
        }
    }

    public function show(int $id): JsonResponse
    {
        try {
            $data = $this->governmentAgencyServices->getAgencyById($id);
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message = $th->getMessage();
            return Response::Error([], $message);
        }
    }

    public function store(StoreAgencyRequest $request): JsonResponse
    {
        try {
            $data = $this->governmentAgencyServices->createAgency($request->validated());
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message = $th->getMessage();
            return Response::Error([], $message);
        }
    }

    public function update(UpdateAgencyRequest $request, int $id): JsonResponse
    {
        try {
            $data = $this->governmentAgencyServices->updateAgency($id, $request->validated());
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message = $th->getMessage();
            return Response::Error([], $message);
        }
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            $data = $this->governmentAgencyServices->deleteAgency($id);
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message = $th->getMessage();
            return Response::Error([], $message);
        }
    }

    public function search(SearchAgencyRequest $request): JsonResponse
    {
        try {
            $data = $this->governmentAgencyServices->searchAgencies($request->validated());
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message = $th->getMessage();
            return Response::Error([], $message);
        }
    }
    public function getFullAgencies(GetFullAgenciesRequest $request): JsonResponse
    {
        try {
            $data = $this->governmentAgencyServices->getFullAgencies($request->validated());
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message = $th->getMessage();
            return Response::Error([], $message);
        }
    }
}
