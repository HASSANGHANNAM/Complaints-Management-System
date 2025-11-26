<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'FirstnameAr'        => 'required|string|max:100',
            'FirstnameEn'        => 'nullable|string|max:100',
            'LastnameAr'         => 'required|string|max:100',
            'LastnameEn'         => 'nullable|string|max:100',
            'MiddlenameAr'       => 'nullable|string|max:100',
            'MiddlenameEn'       => 'nullable|string|max:100',
            'BirthPlaceAr'       => 'required|string|max:255',
            'BirthPlaceEn'       => 'nullable|string|max:255',
            'BirthDate'          => 'required|date',
            'NationalNumber'     => 'required|digits:13|unique:users,NationalNumber',
            'IdFrontFace'        => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'IdBackFace'         => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'CurrentLocationAr'  => 'required|string|max:255',
            'CurrentLocationEn'  => 'nullable|string|max:255',
            'ContactNumber'      => 'required|digits:10',
            'Email'              => 'required|email|unique:users,Email',
            'password'           => 'required|string|min:8',
        ];
    }

    public function attributes(): array
    {
        return [
            'FirstnameAr' => 'الاسم الأول عربي',
            'FirstnameEn' => 'الاسم الأول إنجليزي',
            'LastnameAr'  => 'اسم العائلة عربي',
            'LastnameEn'  => 'اسم العائلة إنجليزي',
            'BirthDate'   => 'تاريخ الميلاد',
            'NationalNumber' => 'الرقم الوطني',
            'ContactNumber'  => 'رقم الهاتف',
            'Email'          => 'البريد الإلكتروني',
        ];
    }

}
