<?php

namespace App\Services;

use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\GovernmentAgencyRepositoryInterface;
use App\Services\NotificationService;
use Illuminate\Support\Facades\DB;

class GovernmentAgencyManagerService
{
    public function __construct(
        private UserRepositoryInterface $userRepo,
        private GovernmentAgencyRepositoryInterface $agencyRepo,
        private NotificationService $notificationService
    ) {}

    public function createManager(array $data, int $agencyId): array
    {
        $agency = $this->agencyRepo->findById($agencyId);

        if (!$agency) {
            return [
                'data' => [],
                'message' => 'Agency not found!',
                'code' => 404
            ];
        }

        if ($agency->ManagerId) {
            return [
                'data' => [],
                'message' => 'Agency already has a manager!',
                'code' => 409
            ];
        }

        DB::transaction(function () use (&$manager, $data, $agency) {
            $manager = $this->userRepo->create($data);
            $this->userRepo->assignRole($manager, 'agencyManager');

            $this->agencyRepo->update($agency, [
                'ManagerId' => $manager->id
            ]);
        });

            // notification
        $this->notificationService->send(
            $manager,
            'تم تعيينك مديرًا',
            "تم تعيينك مديرًا لجهة {$agency->NameAr}",
            'agency_manager_assigned'
        );

        return [
            'data' => [
                'manager_id' => $manager->id,
                'agency_id' => $agency->id
            ],
            'message' => 'Manager created and assigned successfully!',
            'code' => 201
        ];
    }
}
