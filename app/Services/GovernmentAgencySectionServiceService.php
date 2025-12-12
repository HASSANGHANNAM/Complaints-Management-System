<?php

namespace App\Services;

use App\Repositories\Contracts\GovernmentAgencySectionServiceRepositoryInterface;
use App\Models\GovernmentAgencySection;
use Illuminate\Support\Facades\Auth;

class GovernmentAgencySectionServiceService
{
    public function __construct(
        private GovernmentAgencySectionServiceRepositoryInterface $serviceRepo
    ) {}

    public function createService(int $sectionId, array $data): array
    {
        $section = GovernmentAgencySection::find($sectionId);

        if (!$section) {
            return ['data' => [], 'message' => 'Section not found!', 'code' => 404];
        }

        // if ($section->AgencyId !== Auth::user()->AgencyId) {
        //     return ['data' => [], 'message' => 'You cannot add services to a section outside your agency!', 'code' => 403];
        // }

        $data['SectionId'] = $sectionId;

        $service = $this->serviceRepo->create($data);

        return ['data' => $service, 'message' => 'Service created successfully!', 'code' => 201];
    }

    public function updateService(int $id, array $data): array
    {
        $service = $this->serviceRepo->findById($id);
        if (!$service) {
            return ['data' => [], 'message' => 'Service not found!', 'code' => 404];
        }

        $this->serviceRepo->update($service, $data);

        return ['data' => $service, 'message' => 'Service updated successfully!', 'code' => 200];
    }

    public function deleteService(int $id): array
    {
        $deleted = $this->serviceRepo->delete($id);

        if (!$deleted) {
            return ['data' => [], 'message' => 'Service not found!', 'code' => 404];
        }

        return ['data' => [], 'message' => 'Service deleted successfully!', 'code' => 200];
    }

    public function getService(int $id): array
    {
        $service = $this->serviceRepo->findById($id);

        if (!$service) {
            return ['data' => [], 'message' => 'Service not found!', 'code' => 404];
        }

        return ['data' => $service, 'message' => 'Service retrieved successfully!', 'code' => 200];
    }

    // public function listServices(): array
    // {
    //     $data = $this->serviceRepo->all();

    //     return [
    //         'data' => $data->toArray(),
    //         'message' => 'Services list retrieved successfully!',
    //         'code' => 200
    //     ];
    // }
}
