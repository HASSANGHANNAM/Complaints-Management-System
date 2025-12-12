<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateSectionServiceRequest extends FormRequest
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
            'NameAr' => 'required|string|max:255',
            'NameEn' => 'nullable|string|max:255',
            'DescriptionAr' => 'nullable|string|max:500',
            'DescriptionEn' => 'nullable|string|max:500',
        ];
    }
}
