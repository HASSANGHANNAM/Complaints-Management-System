<?php

namespace App\Http\Requests\Complaints;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserResponseRequest extends FormRequest
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
            'Response'       => 'required|string|max:255',
            'ParentId'       => 'required|exists:complaint_responses,id',
            'media'       => 'sometimes|array',
            'media.*'     => 'file|mimes:jpg,jpeg,png,mp4,pdf|max:20480',
        ];
    }
}
