<?php

namespace App\Repositories;

use App\Models\GovernmentAgencyEmployee;
use App\Repositories\Contracts\GovernmentAgencyEmployeeRepositoryInterface;
use Ramsey\Collection\Collection;

class GovernmentAgencyEmployeeRepository implements GovernmentAgencyEmployeeRepositoryInterface
{
    public function __construct(private GovernmentAgencyEmployee $employee) {}

    public function all(): Collection
    {
        return new Collection(GovernmentAgencyEmployee::class, GovernmentAgencyEmployee::all()->toArray());
    }

    public function create(array $data): GovernmentAgencyEmployee
    {
        return $this->employee->create([
            'EmploymentStatus' => $data['EmploymentStatus'] ?? null,
            'EmploymentDate' => $data['EmploymentDate'] ?? null,
            'CanResponseToComplaint' => $data['CanResponseToComplaint'] ?? false,
            'CanChangeComplaintStatus' => $data['CanChangeComplaintStatus'] ?? false,
            'UserId' => $data['UserId'],
            'EmploymentTypeId' => $data['EmploymentTypeId'] ?? null,
        ]);
    }

    public function update(GovernmentAgencyEmployee $employee, array $data): bool
    {
        return $employee->update($data);
    }

    public function delete(int $id): bool
    {
        $employee = $this->findById($id);
        if (!$employee) {
            return false;
        }
        return $employee->delete();
    }

    public function findById(int $id): ?GovernmentAgencyEmployee
    {
        return $this->employee->find($id);
    }
}
