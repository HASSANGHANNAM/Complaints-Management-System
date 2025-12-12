<?php

namespace App\Repositories;

use App\Models\Complaint;
use App\Models\Media;
use Illuminate\Support\Facades\DB;
use App\Repositories\Contracts\ComplaintRepositoryInterface;
use Ramsey\Collection\Collection;

class ComplaintRepository implements ComplaintRepositoryInterface
{
    public function __construct(private Complaint $complaint) {}

    public function all(): Collection
    {
        return new Collection(Complaint::class, Complaint::all()->toArray());
    }
    public function getUserComplaints($request = []): array
    {
        $query = Complaint::where('UserId', Auth()->id());
        if (isset($request['Status']) && !empty($request['Status'])) {
            $query->whereRaw("(
            SELECT cs.Status FROM complaint_statuses cs
            WHERE cs.ComplaintId = complaints.id
            ORDER BY cs.created_at DESC LIMIT 1
        ) = ?", [$request['Status']]);
        }
        if (isset($request['Title']) && !empty($request['Title'])) {
            $query->where('complaints.Title', 'LIKE', '%' . $request['Title'] . '%');
        }
        if (isset($request['SectionId']) && !empty($request['SectionId'])) {
            $query->where('complaints.SectionId', $request['SectionId']);
        }
        if (isset($request['AgencyId']) && !empty($request['AgencyId'])) {
            $query->where('complaints.AgencyId', $request['AgencyId']);
        }
        return $query
            ->selectRaw(
                "complaints.id, complaints.Title, complaints.Content, complaints.created_at as complaint_created_at,
            (
                SELECT cs.Status FROM complaint_statuses cs
                WHERE cs.ComplaintId = complaints.id
                ORDER BY cs.created_at DESC LIMIT 1
            ) as status"
            )
            ->orderBy('complaints.created_at', 'desc')
            ->get()
            ->toArray();
    }
    public function getComplaintDetails($id): array
    {
        $base = rtrim(url('/'), '/');

        $result = Complaint::where('UserId', auth()->id())
            ->where('complaints.id', $id)
            ->select([
                'complaints.id',
                'complaints.Title',
                'complaints.Content',
                'complaints.created_at as complaint_created_at'
            ])
            ->selectRaw("(
            SELECT cs.Status FROM complaint_statuses cs 
            WHERE cs.ComplaintId = complaints.id 
            ORDER BY cs.created_at DESC LIMIT 1
        ) as status")
            ->first();

        if (!$result) {
            return [];
        }

        $data = $result->toArray();

        $media = DB::table('media')
            ->where('ComplaintId', $id)
            ->select([
                'id',
                'Media as file_path',
                'created_at'
            ])
            ->selectRaw("CONCAT('$base', '/api/media/', id) as url")
            ->get()
            ->map(function ($item) {
                $fileName = basename($item->file_path);
                $extension = pathinfo($item->file_path, PATHINFO_EXTENSION);

                $cleanName = preg_replace('/_[a-f0-9]{8}-[a-f0-9]{4}-[a-f0-9]{4}-[a-f0-9]{4}-[a-f0-9]{12}/', '', $fileName);
                return [
                    'id' => $item->id,
                    'url' => $item->url,
                    'file_name' => $cleanName,
                    'extension' => $extension,
                    'created_at' => $item->created_at,

                ];
            })
            ->toArray();

        $data['media'] = $media;

        return $data;
    }
    public function create(array $data): Complaint
    {
        return $this->complaint->create([
            'Title' => $data['Title'],
            'Content' => $data['Content'],
            'EmployeeId' => $data['EmployeeId'] ?? null,
            'UserId' => auth()->id() ?? $data['UserId'],
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
