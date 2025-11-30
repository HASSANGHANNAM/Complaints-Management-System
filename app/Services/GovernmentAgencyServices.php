<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\EmailVerificationRepositoryInterface;
use App\Repositories\Contracts\GovernmentAgencyRepositoryInterface;
use App\Repositories\Contracts\GovernmentAgencySectionRepositoryInterface;


class GovernmentAgencyServices
{

    public function __construct(
        private GovernmentAgencyRepositoryInterface $governmentAgencyRepo,
        private GovernmentAgencySectionRepositoryInterface $governmentAgencySectionRepo
    ) {}

    public function getAgencies($request): array
    {
        $data = $this->governmentAgencyRepo->allActive($request);
        $code = 200;
        $message = 'Agencies retrieved successfully!';
        return ['data' => $data, 'message' => $message, 'code' => $code];
    }

    public function getSections($request, int $agencyId): array
    {
        $data = $this->governmentAgencySectionRepo->allByAgency($request, $agencyId);
        $code = 200;
        $message = 'Sections retrieved successfully!';
        return ['data' => $data, 'message' => $message, 'code' => $code];
    }
}
