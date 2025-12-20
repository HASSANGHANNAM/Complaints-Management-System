<?php

namespace App\Repositories;

use App\Models\GovernmentAgency;
use App\Models\User;
use App\Repositories\Contracts\GovernmentAgencyRepositoryInterface;
use Ramsey\Collection\Collection;

class GovernmentAgencyRepository implements GovernmentAgencyRepositoryInterface
{
    public function __construct(private GovernmentAgency $agency) {}

    public function all(): \Ramsey\Collection\Collection
    {
        return new \Ramsey\Collection\Collection(GovernmentAgency::class, GovernmentAgency::all()->toArray());
    }
    public function allCollection(): \Illuminate\Database\Eloquent\Collection
    {
        return GovernmentAgency::all();
    }
    public function allWithRelations(array $relations = []): array
    {
        if (empty($relations)) {
            return GovernmentAgency::all()->toArray();
        }
        return GovernmentAgency::with($relations)->get()->toArray();
    }

    public function allActive($request = []): array
    {
        $query = GovernmentAgency::where('Status', true);

        if ($request['lang'] === "Ar") {
            $query->select([
                'Id',
                'NameAr',
                'DescriptionAr',
                'LocationAr',
                'WorkingStartTime',
                'WorkingEndTime',
                'Status',
                'ParentId',
                'ManagerId',
            ]);

            if (isset($request['NameAr']) && !empty($request['NameAr'])) {
                $query->where('NameAr', 'like', '%' . $request['NameAr'] . '%');
            }
        } else {
            $query->select([
                'Id',
                'NameEn',
                'DescriptionEn',
                'LocationEn',
                'WorkingStartTime',
                'WorkingEndTime',
                'Status',
                'ParentId',
                'ManagerId',
            ]);

            if (isset($request['NameEn']) && !empty($request['NameEn'])) {
                $query->where('NameEn', 'like', '%' . $request['NameEn'] . '%');
            }
        }

        return $query->get()->toArray();
    }
    public function create(array $data): GovernmentAgency
    {
        return $this->agency->create([
            'NameAr' => $data['NameAr'],
            'NameEn' => $data['NameEn'] ?? null,
            'DescriptionAr' => $data['DescriptionAr'] ?? null,
            'DescriptionEn' => $data['DescriptionEn'] ?? null,
            'LocationAr' => $data['LocationAr'] ?? null,
            'LocationEn' => $data['LocationEn'] ?? null,
            'WorkingStartTime' => $data['WorkingStartTime'] ?? null,
            'WorkingEndTime' => $data['WorkingEndTime'] ?? null,
            'Status' => $data['Status'] ?? true,
            'ParentId' => $data['ParentId'] ?? null,
            'ManagerId' => $data['ManagerId'],
        ]);
    }

    public function update(GovernmentAgency $agency, array $data): bool
    {
        return $agency->update($data);
    }

    public function delete(int $id): bool
    {
        $agency = $this->findById($id);
        if (!$agency) {
            return false;
        }
        return $agency->delete();
    }

    public function findById(int $id): ?GovernmentAgency
    {
        return $this->agency->find($id);
    }
    // public function allActiveWithDetails($request = []): array
    // {
    //     $query = GovernmentAgency::where('Status', true);
    //     $query->select([
    //         'Id',
    //         'NameAr',
    //         'NameEn',
    //         'DescriptionAr',
    //         'DescriptionEn',
    //         'LocationAr',
    //         'LocationEn',
    //         'WorkingStartTime',
    //         'WorkingEndTime',
    //         'Status',
    //         'ParentId',
    //         'ManagerId',
    //     ]);
    //     if (isset($request['NameAr']) && !empty($request['NameAr'])) {
    //         $query->where('NameAr', 'like', '%' . $request['NameAr'] . '%');
    //     }
    //     if (isset($request['NameEn']) && !empty($request['NameEn'])) {
    //         $query->where('NameEn', 'like', '%' . $request['NameEn'] . '%');
    //     }

    //     return $query->get()->toArray();
    // }
    public function allActiveWithDetails($request = []): array
    {
        $query = GovernmentAgency::where('agencies.Status', true)
            ->leftJoin('users', 'agencies.ManagerId', '=', 'users.id')
            ->select([
                'agencies.id',
                'agencies.NameAr',
                'agencies.NameEn',
                'agencies.DescriptionAr',
                'agencies.DescriptionEn',
                'agencies.LocationAr',
                'agencies.LocationEn',
                'agencies.WorkingStartTime',
                'agencies.WorkingEndTime',
                'agencies.Status',
                'agencies.ParentId',
                'agencies.ManagerId',
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
                'users.CurrentLocationAr',
                'users.CurrentLocationEn',
                'users.ContactNumber',
                'users.Email',
                'users.IdFrontFace',
                'users.IdBackFace'
            ]);

        if (isset($request['NameAr']) && !empty($request['NameAr'])) {
            $query->where('agencies.NameAr', 'like', '%' . $request['NameAr'] . '%');
        }
        if (isset($request['NameEn']) && !empty($request['NameEn'])) {
            $query->where('agencies.NameEn', 'like', '%' . $request['NameEn'] . '%');
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
    public function allManagers(): array
    {
        $query = User::query();

        $results = $query->join('agencies', 'agencies.ManagerId', '=', 'users.id')
            ->select([
                'users.id',
                'agencies.id as agency_id',
                'agencies.NameAr',
                'agencies.NameEn',
                'agencies.DescriptionAr',
                'agencies.DescriptionEn',
                'agencies.LocationAr',
                'agencies.LocationEn',
                'agencies.WorkingStartTime',
                'agencies.WorkingEndTime',
                'agencies.Status',
                'agencies.ParentId',
                'agencies.ManagerId',
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
                'users.CurrentLocationAr',
                'users.CurrentLocationEn',
                'users.ContactNumber',
                'users.Email',
                'users.IdFrontFace',
                'users.IdBackFace'
            ])->get();
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

        // dd($results);
        return $results->toArray();
    }
}
