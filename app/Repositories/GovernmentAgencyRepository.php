<?php

namespace App\Repositories;

use App\Models\GovernmentAgency;
use App\Repositories\Contracts\GovernmentAgencyRepositoryInterface;
use Ramsey\Collection\Collection;

class GovernmentAgencyRepository implements GovernmentAgencyRepositoryInterface
{
    public function __construct(private GovernmentAgency $agency) {}

    public function all(): Collection
    {
        return new Collection(GovernmentAgency::class, GovernmentAgency::all()->toArray());
    }

    public function create(array $data): GovernmentAgency
    {
        return $this->agency->create([
            'NameAr' => $data['NameAr'],
            'NameEn' => $data['NameEn'] ?? null,
            'DescriptionAr' => $data['DescriptionAr'] ?? null,
            'DescriptionEn' => $data['DescriptionEn'] ?? null,
            'LocationAr' => $data['LocationAr'] ?? null,
            'LocationEn' => $data['LocationEn'] ?? null,
            'WorkingStartTime' => $data['WorkingStartTime'] ?? null,
            'WorkingEndTime' => $data['WorkingEndTime'] ?? null,
            'Status' => $data['Status'] ?? true,
            'ParentId' => $data['ParentId'] ?? null,
            'ManagerId' => $data['ManagerId'],
        ]);
    }

    public function update(GovernmentAgency $agency, array $data): bool
    {
        return $agency->update($data);
    }

    public function delete(int $id): bool
    {
        $agency = $this->findById($id);
        if (!$agency) {
            return false;
        }
        return $agency->delete();
    }

    public function findById(int $id): ?GovernmentAgency
    {
        return $this->agency->find($id);
    }
}
