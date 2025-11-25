<?php

namespace App\Repositories;

use App\Models\GovernmentAgencyEmploymentType;
use App\Repositories\Contracts\GovernmentAgencyEmploymentTypeRepositoryInterface;
use Ramsey\Collection\Collection;

class GovernmentAgencyEmploymentTypeRepository implements GovernmentAgencyEmploymentTypeRepositoryInterface
{
    public function __construct(private GovernmentAgencyEmploymentType $employmentType) {}

    public function all(): Collection
    {
        return new Collection(GovernmentAgencyEmploymentType::class, GovernmentAgencyEmploymentType::all()->toArray());
    }

    public function create(array $data): GovernmentAgencyEmploymentType
    {
        return $this->employmentType->create([
            'NameAr' => $data['NameAr'],
            'NameEn' => $data['NameEn'] ?? null,
        ]);
    }

    public function update(GovernmentAgencyEmploymentType $employmentType, array $data): bool
    {
        return $employmentType->update($data);
    }

    public function delete(int $id): bool
    {
        $employmentType = $this->findById($id);
        if (!$employmentType) {
            return false;
        }
        return $employmentType->delete();
    }

    public function findById(int $id): ?GovernmentAgencyEmploymentType
    {
        return $this->employmentType->find($id);
    }
}

