<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEmployeeRequest extends FormRequest
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
        return [

            'FirstnameAr' => 'required|string|max:100',
            'FirstnameEn' => 'nullable|string|max:100',
            'MiddlenameAr' => 'nullable|string|max:100',
            'MiddlenameEn' => 'nullable|string|max:100',
            'LastnameAr' => 'required|string|max:100',
            'LastnameEn' => 'nullable|string|max:100',

            'BirthPlaceAr' => 'required|string|max:100',
            'BirthPlaceEn' => 'nullable|string|max:100',

            'BirthDate' => 'required|date',

            'NationalNumber' => 'required|string|max:20|unique:users,NationalNumber',

            'IdFrontFace' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'IdBackFace' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',

            'CurrentLocationAr' => 'required|string|max:255',
            'CurrentLocationEn' => 'nullable|string|max:255',

            'ContactNumber' => 'required|string|max:20',

            'Email' => 'required|email|max:255|unique:users,Email',

            'password' => 'required|string|min:6',

            'email_verified_at' => 'nullable|date',


            'EmploymentStatus' => 'nullable|string|max:100',
            'EmploymentDate' => 'nullable|date',

            'CanResponseToComplaint' => 'required|boolean',
            'CanChangeComplaintStatus' => 'required|boolean',

        ];
    }
}
