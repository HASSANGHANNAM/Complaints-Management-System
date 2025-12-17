<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAgencyManagerRequest extends FormRequest
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
            // User info
            'FirstnameAr' => ['required', 'string', 'max:255'],
            'FirstnameEn' => ['nullable', 'string', 'max:255'],
            'MiddlenameAr' => ['nullable', 'string', 'max:255'],
            'MiddlenameEn' => ['nullable', 'string', 'max:255'],
            'LastnameAr' => ['required', 'string', 'max:255'],
            'LastnameEn' => ['nullable', 'string', 'max:255'],
            'BirthPlaceAr' => ['required', 'string'],
            'BirthPlaceEn' => ['nullable', 'string'],
            'BirthDate' => ['required', 'date'],
            'NationalNumber' => ['required', 'unique:users,NationalNumber'],
            'CurrentLocationAr' => ['required', 'string'],
            'CurrentLocationEn' => ['nullable', 'string'],
            'ContactNumber' => ['required', 'string'],
            'Email' => ['required', 'email', 'unique:users,Email'],
            'password' => ['required', 'string', 'min:8'],
        ];
    }


    protected function prepareForValidation(): void
    {
        $this->merge([
            'AgencyId' => $this->route('agencyId'),
        ]);
    }
}
