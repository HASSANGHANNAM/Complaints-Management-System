<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateAgencyRequest extends FormRequest
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
            'NameAr'          => 'required|string|max:255',
            'NameEn'          => 'required|string|max:255',
            'DescriptionAr'   => 'required|string',
            'DescriptionEn'   => 'required|string',
            'LocationAr'      => 'required|string|max:255',
            'LocationEn'      => 'required|string|max:255',
            'WorkingStartTime'=> 'required|date_format:H:i',
            'WorkingEndTime'  => 'required|date_format:H:i|after:WorkingStartTime',
            'ParentId'        => 'nullable|exists:agencies,id',
            'ManagerId'       => 'required|exists:users,id',
        ];
    }
}
