<?php

namespace App\Http\Requests\GovernmentAgency;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAgencyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'NameAr' => 'required|string|max:255',
            'NameEn' => 'required|string|max:255',
            'DescriptionAr' => 'nullable|string',
            'DescriptionEn' => 'nullable|string',
            'LocationAr' => 'nullable|string',
            'LocationEn' => 'nullable|string',
            'WorkingStartTime' => 'nullable|date_format:H:i',
            'WorkingEndTime' => 'nullable|date_format:H:i|after:WorkingStartTime',
            'Status' => 'boolean',
            'ParentId' => [
                'nullable',
                'integer',
                Rule::exists('agencies', 'id')->where(function ($query) {
                    $query->where('id', '!=', $this->route('id'));
                })
            ],
            'ManagerId' => 'nullable|exists:users,id'
        ];
    }

    public function messages(): array
    {
        return [
            'NameAr.required' => 'Arabic name is required',
            'NameEn.required' => 'English name is required',
            'WorkingEndTime.after' => 'Working end time must be after start time',
            'ParentId.exists' => 'Selected parent agency does not exist',
            'ManagerId.exists' => 'Selected manager does not exist'
        ];
    }
}
