<?php

namespace App\Repositories\Contracts;

use App\Models\Complaint;
use Ramsey\Collection\Collection;

interface ComplaintRepositoryInterface
{
    public function all(): Collection;
    public function getUserComplaints(array $request = []): array;
    public function getComplaintDetails(int $id): array;
    public function create(array $data): Complaint;
    public function update(Complaint $complaint, array $data): bool;
    public function delete(int $id): bool;
    public function findById(int $id): ?Complaint;
}
