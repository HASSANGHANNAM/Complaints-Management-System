<?php

namespace App\Repositories;

use App\Models\ComplaintStatus;
use App\Repositories\Contracts\ComplaintStatusRepositoryInterface;
use Ramsey\Collection\Collection;

class ComplaintStatusRepository implements ComplaintStatusRepositoryInterface
{
    public function __construct(private ComplaintStatus $complaintStatus) {}

    public function all(): Collection
    {
        return new Collection(ComplaintStatus::class, ComplaintStatus::all()->toArray());
    }

    public function create(array $data): ComplaintStatus
    {
        return $this->complaintStatus->create([
            'Status' => $data['Status'],
            'ComplaintId' => $data['ComplaintId'],
        ]);
    }

    public function update(ComplaintStatus $complaintStatus, array $data): bool
    {
        return $complaintStatus->update($data);
    }

    public function delete(int $id): bool
    {
        $complaintStatus = $this->findById($id);
        if (!$complaintStatus) {
            return false;
        }
        return $complaintStatus->delete();
    }

    public function findById(int $id): ?ComplaintStatus
    {
        return $this->complaintStatus->find($id);
    }
}

