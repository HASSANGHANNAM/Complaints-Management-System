<?php

namespace App\Repositories\Contracts;

use App\Models\GovernmentAgencySectionService;
use Ramsey\Collection\Collection;

interface GovernmentAgencySectionServiceRepositoryInterface
{
    public function all(): Collection;
    public function create(array $data): GovernmentAgencySectionService;
    public function update(GovernmentAgencySectionService $service, array $data): bool;
    public function delete(int $id): bool;
    public function findById(int $id): ?GovernmentAgencySectionService;
    public function allServices(array $request = [], $id): array;
}
