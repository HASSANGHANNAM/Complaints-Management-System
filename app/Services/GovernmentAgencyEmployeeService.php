<?php

namespace App\Services;

use App\Repositories\Contracts\GovernmentAgencyEmployeeRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;

class GovernmentAgencyEmployeeService
{
    public function __construct(
        private GovernmentAgencyEmployeeRepositoryInterface $employeeRepo,
        private UserRepositoryInterface $userRepo
    ) {}

    public function createEmployee(array $data): array
    {
        return DB::transaction(function () use ($data) {

            // Create User first
            $user = $this->userRepo->create($data);

            // Assign role to the user
            $this->userRepo->assignRole($user, 'employee');

            // Create related GovernmentAgencyEmployee record
            $employee = $this->employeeRepo->create([
                'EmploymentStatus' => $data['EmploymentStatus'] ?? null,
                'EmploymentDate' => $data['EmploymentDate'] ?? null,
                'CanResponseToComplaint' => $data['CanResponseToComplaint'] ?? false,
                'CanChangeComplaintStatus' => $data['CanChangeComplaintStatus'] ?? false,
                'UserId' => $user->id,
            ]);

            return [
                'data' => [
                    'user' => $user,
                    'employee' => $employee,
                ],
                'message' => 'Employee created successfully!',
                'code' => 201
            ];
        });
    }

public function updateEmployee(int $id, array $data): array
{
    $employee = $this->employeeRepo->findById($id);
    if (!$employee) {
        return ['data' => [], 'message' => 'Employee not found!', 'code' => 404];
    }


    $employeeData = array_filter($data, function($key){
        return in_array($key, ['EmploymentStatus','EmploymentDate','CanResponseToComplaint','CanChangeComplaintStatus']);
    }, ARRAY_FILTER_USE_KEY);

    $employee->update($employeeData);


    $user = $employee->user;
    if ($user) {
        $userData = array_filter($data, function($key){
            return in_array($key, [
                'FirstnameAr','FirstnameEn','MiddlenameAr','MiddlenameEn',
                'LastnameAr','LastnameEn','BirthPlaceAr','BirthPlaceEn',
                'BirthDate','NationalNumber','Email','CurrentLocationAr','CurrentLocationEn',
                'ContactNumber','password','email_verified_at'
            ]);
        }, ARRAY_FILTER_USE_KEY);

        if(isset($userData['password'])){
            $userData['password'] = \Hash::make($userData['password']);
        }

        $this->userRepo->update($user, $userData);
    }

    return ['data' => $employee, 'message' => 'Employee updated successfully!', 'code' => 200];
}


    public function deleteEmployee(int $id): array
    {
        $deleted = $employee = $this->employeeRepo->delete($id);

        if (!$deleted) {
            return ['data' => [], 'message' => 'Employee not found!', 'code' => 404];
        }

        return ['data' => [], 'message' => 'Employee deleted successfully!', 'code' => 200];
    }

    public function getEmployee(int $id): array
    {
        $employee = $this->employeeRepo->findById($id);

        if (!$employee) {
            return ['data' => [], 'message' => 'Employee not found!', 'code' => 404];
        }
        $employee->load('user');

        return [
            'data' => $employee,
            'message' => 'Employee retrieved successfully!',
            'code' => 200
        ];
    }

    public function listEmployees(): array
    {
        $data = $this->employeeRepo->all();

        return [
            'data' => $data->toArray(),
            'message' => 'Employees list retrieved successfully!',
            'code' => 200
        ];
    }
}
