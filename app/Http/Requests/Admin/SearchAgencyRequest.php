<?php

namespace App\Http\Requests\GovernmentAgency;

use Illuminate\Foundation\Http\FormRequest;

class SearchAgencyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'search' => 'nullable|string|min:2|max:255',
            'status' => 'nullable|boolean',
            'parent_id' => 'nullable|exists:agencies,id',
            'manager_id' => 'nullable|exists:users,id',
            'per_page' => 'nullable|integer|min:1|max:100',
            'page' => 'nullable|integer|min:1'
        ];
    }
}
