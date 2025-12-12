<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $employee = \App\Models\GovernmentAgencyEmployee::with('user')->find($this->route('id'));
        $userId = $employee && $employee->user ? $employee->user->id : null;


        return [

            'EmploymentStatus' => 'nullable|string|max:100',
            'EmploymentDate' => 'nullable|date',
            'CanResponseToComplaint' => 'nullable|boolean',
            'CanChangeComplaintStatus' => 'nullable|boolean',



            'FirstnameAr' => 'sometimes|string|max:100',
            'FirstnameEn' => 'sometimes|string|max:100',
            'MiddlenameAr' => 'sometimes|string|max:100',
            'MiddlenameEn' => 'sometimes|string|max:100',
            'LastnameAr' => 'sometimes|string|max:100',
            'LastnameEn' => 'sometimes|string|max:100',

            'BirthPlaceAr' => 'sometimes|string|max:100',
            'BirthPlaceEn' => 'sometimes|string|max:100',

            'BirthDate' => 'sometimes|date',

            'NationalNumber' => 'sometimes|string|max:20|unique:users,NationalNumber,' . $userId,

            'IdFrontFace' => 'sometimes|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'IdBackFace' => 'sometimes|file|mimes:jpg,jpeg,png,pdf|max:2048',

            'CurrentLocationAr' => 'sometimes|string|max:255',
            'CurrentLocationEn' => 'sometimes|string|max:255',

            'ContactNumber' => 'sometimes|string|max:20',

            'Email' => 'sometimes|email|max:255|unique:users,Email,' . $userId,

            'password' => 'sometimes|string|min:6',

            'email_verified_at' => 'nullable|date',

        ];
    }
}
