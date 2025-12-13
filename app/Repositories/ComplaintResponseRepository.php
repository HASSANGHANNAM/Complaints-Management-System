<?php

namespace App\Repositories;

use App\Models\ComplaintResponse;
use App\Repositories\Contracts\ComplaintResponseRepositoryInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
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
        $user = auth()->user();
        if ($user !== null) {
            $userEmployee = DB::table('agency_employees')->where('UserId', auth()->user()->id)->first();
            if ($userEmployee) {
                $data['EmployeeId'] = $userEmployee->id;
                $data['UserId'] = null;
            } else {
                $data['EmployeeId'] = null;
                $data['UserId'] = $user->id;
            }
        }

        return $this->complaintResponse->create([
            'Response' => $data['Response'],
            'EmployeeId' =>  $data['EmployeeId'],
            'UserId' => $data['UserId'],
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
    public function getResponsesByComplaintId(int $id): array
    {
        // $start = microtime(true);

        $responses = DB::table('complaint_responses')
            ->select(['id', 'Response', 'EmployeeId', 'UserId', 'ParentId', 'created_at'])
            ->where('ComplaintId', $id)
            ->get()
            ->map(function ($item) {
                $item->children = [];
                return $item;
            })
            ->keyBy('id');


        $tree = [];

        foreach ($responses as $id => $response) {
            if ($response->ParentId === null) {
                $tree[] = $response;
            } elseif (isset($responses[$response->ParentId])) {
                $responses[$response->ParentId]->children[] = $response;
            }
        }
        // $time = microtime(true) - $start;
        // dd($time);
        return $tree;
    }
}
