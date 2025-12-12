<?php

namespace App\Http\Requests\GovernmentAgency;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAgencyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $agencyId = $this->route('id');

        return [
            'NameAr' => 'sometimes|string|max:255',
            'NameEn' => 'sometimes|string|max:255',
            'DescriptionAr' => 'nullable|string',
            'DescriptionEn' => 'nullable|string',
            'LocationAr' => 'nullable|string',
            'LocationEn' => 'nullable|string',
            'WorkingStartTime' => 'nullable|date_format:H:i',
            'WorkingEndTime' => 'nullable|date_format:H:i|after:WorkingStartTime',
            'Status' => 'sometimes|boolean',
            'ParentId' => [
                'nullable',
                'integer',
                Rule::exists('agencies', 'id')->where(function ($query) use ($agencyId) {
                    $query->where('id', '!=', $agencyId);
                })
            ],
            'ManagerId' => 'nullable|exists:users,id'
        ];
    }

    public function messages(): array
    {
        return [
            'WorkingEndTime.after' => 'Working end time must be after start time',
            'ParentId.exists' => 'Selected parent agency does not exist or cannot be itself',
            'ManagerId.exists' => 'Selected manager does not exist'
        ];
    }
}
