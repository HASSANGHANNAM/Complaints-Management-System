<?php

namespace App\Repositories\Contracts;

use App\Models\GovernmentAgency;
use Ramsey\Collection\Collection;

interface GovernmentAgencyRepositoryInterface
{
    public function all(): Collection;
    public function create(array $data): GovernmentAgency;
    public function update(GovernmentAgency $agency, array $data): bool;
    public function delete(int $id): bool;
    public function findById(int $id): ?GovernmentAgency;
}
