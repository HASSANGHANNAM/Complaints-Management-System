<?php

namespace App\Repositories\Contracts;

use App\Models\GovernmentAgencyEmployee;
use Ramsey\Collection\Collection;

interface GovernmentAgencyEmployeeRepositoryInterface
{
    public function all(): Collection;
    public function create(array $data): GovernmentAgencyEmployee;
    public function update(GovernmentAgencyEmployee $employee, array $data): bool;
    public function delete(int $id): bool;
    public function findById(int $id): ?GovernmentAgencyEmployee;
    public function allInMyAgency($request): array;
}
