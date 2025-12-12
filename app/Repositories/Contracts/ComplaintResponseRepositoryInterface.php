<?php

namespace App\Repositories\Contracts;

use App\Models\ComplaintResponse;
use Ramsey\Collection\Collection;

interface ComplaintResponseRepositoryInterface
{
    public function all(): Collection;
    public function create(array $data): ComplaintResponse;
    public function update(ComplaintResponse $complaintResponse, array $data): bool;
    public function delete(int $id): bool;
    public function findById(int $id): ?ComplaintResponse;
}

