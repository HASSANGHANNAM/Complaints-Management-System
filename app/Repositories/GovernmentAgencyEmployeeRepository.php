<?php

namespace App\Repositories;

use App\Models\GovernmentAgencyEmployee;
use App\Repositories\Contracts\GovernmentAgencyEmployeeRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Ramsey\Collection\Collection;

class GovernmentAgencyEmployeeRepository implements GovernmentAgencyEmployeeRepositoryInterface
{
    public function __construct(private GovernmentAgencyEmployee $employee) {}

    public function all(): Collection
    {
        return new Collection(GovernmentAgencyEmployee::all());
    }
    public function create(array $data): GovernmentAgencyEmployee
    {
        return $this->employee->create([
            'EmploymentStatus' => $data['EmploymentStatus'] ?? null,
            'EmploymentDate' => $data['EmploymentDate'] ?? null,
            'CanResponseToComplaint' => $data['CanResponseToComplaint'] ?? false,
            'CanChangeComplaintStatus' => $data['CanChangeComplaintStatus'] ?? false,
            'SectionId' => $data['SectionId'],
            'UserId' => $data['UserId']
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
    public function allInMyAgency($request): array
    {
        $query = GovernmentAgencyEmployee::query()
            ->join('agency_sections', 'agency_employees.SectionId', '=', 'agency_sections.id')
            ->join('agencies', 'agency_sections.AgencyId', '=', 'agencies.id')
            ->join('users', 'agency_employees.UserId', '=', 'users.id')
            ->where('agencies.ManagerId', auth()->user()->id)
            ->select([
                'agency_employees.id',
                'agency_employees.EmploymentStatus',
                'agency_employees.EmploymentDate',
                'agency_employees.CanResponseToComplaint',
                'agency_employees.CanChangeComplaintStatus',
                'users.FirstnameAr',
                'users.FirstnameEn',
                'users.LastnameAr',
                'users.LastnameEn',
                'users.MiddlenameAr',
                'users.MiddlenameEn',
                'users.BirthPlaceAr',
                'users.BirthPlaceEn',
                'users.BirthDate',
                'users.NationalNumber',
                'users.Email',
                'users.ContactNumber',
                'users.CurrentLocationAr',
                'users.CurrentLocationEn',
                'users.IdFrontFace',
                'users.IdBackFace',
                'agency_sections.NameAr as section_name_ar',
                'agency_sections.NameEn as section_name_en',
                'agencies.NameAr as agency_name_ar',
                'agencies.NameEn as agency_name_en'
            ]);
        if (isset($request['section_id']) && !empty($request['section_id'])) {
            $query->where('agency_employees.SectionId', $request['section_id']);
        }
        $results = $query->get();

        $results->transform(function ($item) {
            if (isset($item->IdFrontFace)) {
                $item->IdFrontFace = url("/api/users/{$item->ManagerId}/id-front");
            } else {
                $item->IdFrontFace = null;
            }

            if (isset($item->IdBackFace)) {
                $item->IdBackFace = url("/api/users/{$item->ManagerId}/id-back");
            } else {
                $item->IdBackFace = null;
            }

            return $item;
        });

        return $results->toArray();
    }
}
