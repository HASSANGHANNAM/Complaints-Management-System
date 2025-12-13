<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetServicesRequest extends FormRequest
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
            'NameAr' => 'nullable|string|max:255',
            'NameEn' => 'nullable|string|max:255',
        ];
    }
}
