<?php

namespace App\Services;

use App\Repositories\Contracts\GovernmentAgencySectionRepositoryInterface;
use App\Models\GovernmentAgency;
class GovernmentAgencySectionService
{
    public function __construct(
        private GovernmentAgencySectionRepositoryInterface $sectionRepo
    ) {}

public function createSection(array $data): array
{
    $agency =GovernmentAgency::where('ManagerId', auth()->id())->first();

    if (!$agency) {
        return [
            'data' => [],
            'message' => 'Cannot determine agency for current user!',
            'code' => 403
        ];
    }

    $data['AgencyId'] = $agency->id;
    $section = $this->sectionRepo->create($data);

    return [
        'data' => $section,
        'message' => 'Section created successfully!',
        'code' => 201
    ];
}


    public function updateSection(int $id, array $data): array
    {
        $section = $this->sectionRepo->findById($id);

        if (!$section) {
            return ['data' => [], 'message' => 'Section not found!', 'code' => 404];
        }

        unset($data['AgencyId']);

        $this->sectionRepo->update($section, $data);

        return [
            'data' => $section,
            'message' => 'Section updated successfully!',
            'code' => 200
        ];
    }

    public function deleteSection(int $id): array
    {
        $deleted = $this->sectionRepo->delete($id);

        if (!$deleted) {
            return ['data' => [], 'message' => 'Section not found!', 'code' => 404];
        }

        return [
            'data' => [],
            'message' => 'Section deleted successfully!',
            'code' => 200
        ];
    }

    public function getSection(int $id): array
    {
        $section = $this->sectionRepo->findById($id);

        if (!$section) {
            return ['data' => [], 'message' => 'Section not found!', 'code' => 404];
        }

        return [
            'data' => $section,
            'message' => 'Section retrieved successfully!',
            'code' => 200
        ];
    }

    public function listSections(): array
    {

        $agency =GovernmentAgency::where('ManagerId', auth()->id())->first();

        if (!$agency) {
            return [
                'data' => [],
                'message' => 'Cannot determine agency for current user!',
                'code' => 403
            ];
        }

        $agencyId = $agency->id;
        $filters = request()->all();

        $data = $this->sectionRepo->allByAgency($filters, $agencyId);

        return [
            'data' => $data,
            'message' => 'Sections list retrieved successfully!',
            'code' => 200
        ];
    }

}
