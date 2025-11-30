<?php

namespace App\Repositories\Contracts;

use App\Models\GovernmentAgencySection;
use Ramsey\Collection\Collection;

interface GovernmentAgencySectionRepositoryInterface
{
    public function all(): Collection;
    public function allByAgency(array $request = [], int $agencyId): array;
    public function create(array $data): GovernmentAgencySection;
    public function update(GovernmentAgencySection $section, array $data): bool;
    public function delete(int $id): bool;
    public function findById(int $id): ?GovernmentAgencySection;
}
