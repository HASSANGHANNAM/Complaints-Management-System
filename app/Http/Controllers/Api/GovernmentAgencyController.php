<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GetAgenciesRequest;
use App\Http\Requests\GetSectionsRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RefreshToken;
use App\Http\Requests\RegisterUser;
use App\Http\Requests\VerifyEmailRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Http\Responses\Response;
use App\Services\AuthServices;
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
}
