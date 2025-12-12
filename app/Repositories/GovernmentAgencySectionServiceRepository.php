<?php

namespace App\Repositories;

use App\Models\GovernmentAgencySectionService;
use App\Repositories\Contracts\GovernmentAgencySectionServiceRepositoryInterface;
use Ramsey\Collection\Collection;

class GovernmentAgencySectionServiceRepository implements GovernmentAgencySectionServiceRepositoryInterface
{
    public function __construct(private GovernmentAgencySectionService $service) {}

    public function all(): Collection
    {
        return new Collection(GovernmentAgencySectionService::class, GovernmentAgencySectionService::all()->toArray());
    }

    public function create(array $data): GovernmentAgencySectionService
    {
        return $this->service->create([
            'NameAr' => $data['NameAr'],
            'NameEn' => $data['NameEn'] ?? null,
            'DescriptionAr' => $data['DescriptionAr'] ?? null,
            'DescriptionEn' => $data['DescriptionEn'] ?? null,
            'SectionId' => $data['SectionId'],
        ]);
    }

    public function update(GovernmentAgencySectionService $service, array $data): bool
    {
        return $service->update($data);
    }

    public function delete(int $id): bool
    {
        $service = $this->findById($id);
        if (!$service) {
            return false;
        }
        return $service->delete();
    }

    public function findById(int $id): ?GovernmentAgencySectionService
    {
        return $this->service->find($id);
    }
}

