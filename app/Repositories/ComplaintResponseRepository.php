<?php

namespace App\Repositories;

use App\Models\ComplaintResponse;
use App\Repositories\Contracts\ComplaintResponseRepositoryInterface;
use Ramsey\Collection\Collection;

class ComplaintResponseRepository implements ComplaintResponseRepositoryInterface
{
    public function __construct(private ComplaintResponse $complaintResponse) {}

    public function all(): Collection
    {
        return new Collection(ComplaintResponse::class, ComplaintResponse::all()->toArray());
    }

    public function create(array $data): ComplaintResponse
    {
        return $this->complaintResponse->create([
            'Response' => $data['Response'],
            'EmployeeId' => $data['EmployeeId'] ?? null,
            'UserId' => $data['UserId'] ?? null,
            'ComplaintId' => $data['ComplaintId'],
            'ParentId' => $data['ParentId'] ?? null,
        ]);
    }

    public function update(ComplaintResponse $complaintResponse, array $data): bool
    {
        return $complaintResponse->update($data);
    }

    public function delete(int $id): bool
    {
        $complaintResponse = $this->findById($id);
        if (!$complaintResponse) {
            return false;
        }
        return $complaintResponse->delete();
    }

    public function findById(int $id): ?ComplaintResponse
    {
        return $this->complaintResponse->find($id);
    }
}

