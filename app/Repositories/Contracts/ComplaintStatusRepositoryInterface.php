<?php

namespace App\Repositories\Contracts;

use App\Models\ComplaintStatus;
use Ramsey\Collection\Collection;

interface ComplaintStatusRepositoryInterface
{
    public function all(): Collection;
    public function create(array $data): ComplaintStatus;
    public function update(ComplaintStatus $complaintStatus, array $data): bool;
    public function delete(int $id): bool;
    public function findById(int $id): ?ComplaintStatus;
    public function getTracing(int $id): array;
}
