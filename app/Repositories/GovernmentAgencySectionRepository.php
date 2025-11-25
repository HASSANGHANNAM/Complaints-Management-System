<?php

namespace App\Repositories;

use App\Models\GovernmentAgencySection;
use App\Repositories\Contracts\GovernmentAgencySectionRepositoryInterface;
use Ramsey\Collection\Collection;

class GovernmentAgencySectionRepository implements GovernmentAgencySectionRepositoryInterface
{
    public function __construct(private GovernmentAgencySection $section) {}

    public function all(): Collection
    {
        return new Collection(GovernmentAgencySection::class, GovernmentAgencySection::all()->toArray());
    }

    public function create(array $data): GovernmentAgencySection
    {
        return $this->section->create([
            'NameAr' => $data['NameAr'],
            'NameEn' => $data['NameEn'] ?? null,
            'DescriptionAr' => $data['DescriptionAr'] ?? null,
            'DescriptionEn' => $data['DescriptionEn'] ?? null,
            'AgencyId' => $data['AgencyId'],
        ]);
    }

    public function update(GovernmentAgencySection $section, array $data): bool
    {
        return $section->update($data);
    }

    public function delete(int $id): bool
    {
        $section = $this->findById($id);
        if (!$section) {
            return false;
        }
        return $section->delete();
    }

    public function findById(int $id): ?GovernmentAgencySection
    {
        return $this->section->find($id);
    }
}

