<?php

namespace App\Services;

use App\Models\GovernmentAgency;
use App\Models\GovernmentAgencySection;
use App\Repositories\Contracts\GovernmentAgencyRepositoryInterface;
use App\Repositories\Contracts\GovernmentAgencySectionRepositoryInterface;
use App\Services\NotificationService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class GovernmentAgencyServices
{
    public function __construct(
        private GovernmentAgencyRepositoryInterface $governmentAgencyRepo,
        private GovernmentAgencySectionRepositoryInterface $governmentAgencySectionRepo,
        private NotificationService $notificationService
    ) {}

    public function getAgencies($request): array
    {
        $data = $this->governmentAgencyRepo->allActive($request);
        $code = 200;
        $message = 'Agencies retrieved successfully!';
        return ['data' => $data, 'message' => $message, 'code' => $code];
    }

    public function getSections($request, int $agencyId): array
    {
        $data = $this->governmentAgencySectionRepo->allByAgency($request, $agencyId);
        $code = 200;
        $message = 'Sections retrieved successfully!';
        return ['data' => $data, 'message' => $message, 'code' => $code];
    }

    public function createAgency(array $data): array
    {
        try {
            $validator = Validator::make($data, [
                'NameAr' => 'required|string|max:255',
                'NameEn' => 'required|string|max:255',
                'DescriptionAr' => 'nullable|string',
                'DescriptionEn' => 'nullable|string',
                'LocationAr' => 'nullable|string',
                'LocationEn' => 'nullable|string',
                'WorkingStartTime' => 'nullable|date_format:H:i',
                'WorkingEndTime' => 'nullable|date_format:H:i|after:WorkingStartTime',
                'Status' => 'boolean',
                'ParentId' => 'nullable|exists:agencies,id',
                'ManagerId' => 'nullable|exists:users,id'
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            DB::beginTransaction();

            $agency = $this->governmentAgencyRepo->create($data);

            DB::commit();

            return [
                'data' => $agency,
                'message' => 'Agency created successfully!',
                'code' => 201
            ];
        } catch (ValidationException $e) {
            DB::rollBack();
            return [
                'data' => $e->errors(),
                'message' => 'Validation failed',
                'code' => 422
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            return [
                'data' => null,
                'message' => 'Failed to create agency: ' . $e->getMessage(),
                'code' => 500
            ];
        }
    }

    public function updateAgency(int $id, array $data): array
    {
        try {
            $agency = $this->governmentAgencyRepo->findById($id);

            if (!$agency) {
                return [
                    'data' => null,
                    'message' => 'Agency not found',
                    'code' => 404
                ];
            }

            $validator = Validator::make($data, [
                'NameAr' => 'sometimes|string|max:255',
                'NameEn' => 'sometimes|string|max:255',
                'DescriptionAr' => 'nullable|string',
                'DescriptionEn' => 'nullable|string',
                'LocationAr' => 'nullable|string',
                'LocationEn' => 'nullable|string',
                'WorkingStartTime' => 'nullable|date_format:H:i',
                'WorkingEndTime' => 'nullable|date_format:H:i|after:WorkingStartTime',
                'Status' => 'sometimes|boolean',
                'ParentId' => 'nullable|exists:agencies,id',
                'ManagerId' => 'nullable|exists:users,id'
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            DB::beginTransaction();

            $updated = $this->governmentAgencyRepo->update($agency, $data);

            DB::commit();

            if ($updated) {
                $agency->refresh();
                return [
                    'data' => $agency,
                    'message' => 'Agency updated successfully!',
                    'code' => 200
                ];
            }

            return [
                'data' => null,
                'message' => 'Failed to update agency',
                'code' => 500
            ];
        } catch (ValidationException $e) {
            DB::rollBack();
            return [
                'data' => $e->errors(),
                'message' => 'Validation failed',
                'code' => 422
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            return [
                'data' => null,
                'message' => 'Failed to update agency: ' . $e->getMessage(),
                'code' => 500
            ];
        }
    }

    public function deleteAgency(int $id): array
    {
        try {
            $agency = $this->governmentAgencyRepo->findById($id);

            if (!$agency) {
                return [
                    'data' => null,
                    'message' => 'Agency not found',
                    'code' => 404
                ];
            }

            // Check if agency has children
            if ($agency->children()->count() > 0) {
                return [
                    'data' => null,
                    'message' => 'Cannot delete agency with child agencies',
                    'code' => 400
                ];
            }

            // Check if agency has sections
            if ($agency->sections()->count() > 0) {
                return [
                    'data' => null,
                    'message' => 'Cannot delete agency with sections',
                    'code' => 400
                ];
            }

            DB::beginTransaction();

            $deleted = $this->governmentAgencyRepo->delete($id);

            DB::commit();

            if ($deleted) {
                return [
                    'data' => null,
                    'message' => 'Agency deleted successfully!',
                    'code' => 200
                ];
            }

            return [
                'data' => null,
                'message' => 'Failed to delete agency',
                'code' => 500
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            return [
                'data' => null,
                'message' => 'Failed to delete agency: ' . $e->getMessage(),
                'code' => 500
            ];
        }
    }

    public function getAgencyById(int $id): array
    {
        try {
            $agency = $this->governmentAgencyRepo->findById($id);

            if (!$agency) {
                return [
                    'data' => null,
                    'message' => 'Agency not found',
                    'code' => 404
                ];
            }

            // Load relations
            $agency->load(['parent', 'manager', 'sections', 'children']);

            return [
                'data' => $agency,
                'message' => 'Agency retrieved successfully!',
                'code' => 200
            ];
        } catch (\Exception $e) {
            return [
                'data' => null,
                'message' => 'Failed to retrieve agency: ' . $e->getMessage(),
                'code' => 500
            ];
        }
    }

    public function searchAgencies($request): array
    {
        try {
            $query = GovernmentAgency::query();

            if (isset($request['search'])) {
                $search = $request['search'];
                $query->where(function ($q) use ($search) {
                    $q->where('NameAr', 'LIKE', "%{$search}%")
                        ->orWhere('NameEn', 'LIKE', "%{$search}%")
                        ->orWhere('DescriptionAr', 'LIKE', "%{$search}%")
                        ->orWhere('DescriptionEn', 'LIKE', "%{$search}%");
                });
            }

            if (isset($request['status'])) {
                $query->where('Status', $request['status']);
            }

            $agencies = $query->with(['parent', 'manager', 'sections'])
                ->orderBy('NameEn')
                ->get();

            return [
                'data' => $agencies,
                'message' => 'Agencies search completed successfully!',
                'code' => 200
            ];
        } catch (\Exception $e) {
            return [
                'data' => null,
                'message' => 'Failed to search agencies: ' . $e->getMessage(),
                'code' => 500
            ];
        }
    }
    public function listManagers(): array
    {
        $data = $this->governmentAgencyRepo->allManagers();
        $code = 200;
        $message = 'Managers retrieved successfully!';
        return ['data' => $data, 'message' => $message, 'code' => $code];
    }
}
