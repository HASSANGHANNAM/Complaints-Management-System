<?php

namespace App\Repositories;

use App\Models\Complaint;
use App\Repositories\Contracts\ComplaintRepositoryInterface;
use Ramsey\Collection\Collection;

class ComplaintRepository implements ComplaintRepositoryInterface
{
    public function __construct(private Complaint $complaint) {}

    public function all(): Collection
    {
        return new Collection(Complaint::class, Complaint::all()->toArray());
    }

    public function create(array $data): Complaint
    {
        return $this->complaint->create([
            'Title' => $data['Title'],
            'Content' => $data['Content'],
            'EmployeeId' => $data['EmployeeId'] ?? null,
            'UserId' => $data['UserId'],
            'AgencyId' => $data['AgencyId'] ?? null,
            'SectionId' => $data['SectionId'] ?? null,
        ]);
    }

    public function update(Complaint $complaint, array $data): bool
    {
        return $complaint->update($data);
    }

    public function delete(int $id): bool
    {
        $complaint = $this->findById($id);
        if (!$complaint) {
            return false;
        }
        return $complaint->delete();
    }

    public function findById(int $id): ?Complaint
    {
        return $this->complaint->find($id);
    }
}

