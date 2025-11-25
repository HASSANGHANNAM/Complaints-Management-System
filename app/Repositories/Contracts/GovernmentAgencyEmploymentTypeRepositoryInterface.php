<?php

namespace App\Repositories\Contracts;

use App\Models\GovernmentAgencyEmploymentType;
use Ramsey\Collection\Collection;

interface GovernmentAgencyEmploymentTypeRepositoryInterface
{
    public function all(): Collection;
    public function create(array $data): GovernmentAgencyEmploymentType;
    public function update(GovernmentAgencyEmploymentType $employmentType, array $data): bool;
    public function delete(int $id): bool;
    public function findById(int $id): ?GovernmentAgencyEmploymentType;
}

