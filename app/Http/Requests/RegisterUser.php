<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterUser extends FormRequest
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
        $userId = $this->route('user')?->id;

        return [
            'FirstnameAr' => [
                'required',
                'string',
                'max:255',
                'regex:/^[\p{Arabic}\s]+$/u'
            ],

            'FirstnameEn' => [
                'nullable',
                'string',
                'max:255',
                'regex:/^[a-zA-Z\s]+$/'
            ],

            'LastnameAr' => [
                'required',
                'string',
                'max:255',
                'regex:/^[\p{Arabic}\s]+$/u'
            ],

            'LastnameEn' => [
                'nullable',
                'string',
                'max:255',
                'regex:/^[a-zA-Z\s]+$/'
            ],

            'MiddlenameAr' => [
                'nullable',
                'string',
                'max:255',
                'regex:/^[\p{Arabic}\s]+$/u'
            ],

            'MiddlenameEn' => [
                'nullable',
                'string',
                'max:255',
                'regex:/^[a-zA-Z\s]+$/'
            ],

            'BirthPlaceAr' => [
                'required',
                'string',
                'max:255',
                'regex:/^[\p{Arabic}\s]+$/u'
            ],

            'BirthPlaceEn' => [
                'nullable',
                'string',
                'max:255',
                'regex:/^[a-zA-Z\s]+$/'
            ],

            'BirthDate' => [
                'required',
                'date',
                'before:today',
                'after:1900-01-01'
            ],

            'NationalNumber' => [
                'required',
                'string',
                'max:11',
                'min:11',
                'regex:/^[0-9]+$/',
                Rule::unique('users')->ignore($userId)
            ],

            'IdFrontFace' => [
                $this->isMethod('POST') ? 'required' : 'sometimes',
                'image',
                'mimes:jpeg,png,jpg,gif',
                'max:2048'
            ],

            'IdBackFace' => [
                $this->isMethod('POST') ? 'required' : 'sometimes',
                'image',
                'mimes:jpeg,png,jpg,gif',
                'max:2048'
            ],

            'CurrentLocationAr' => [
                'required',
                'string',
                'max:255',
                'regex:/^[\p{Arabic}\s]+$/u'
            ],

            'CurrentLocationEn' => [
                'nullable',
                'string',
                'max:255',
                'regex:/^[a-zA-Z\s]+$/'
            ],

            'ContactNumber' => [
                'required',
                'string',
                'max:20',
                'regex:/^[+\d\s\-()]+$/'
            ],

            'Email' => [
                'required',
                'email:rfc,dns',
                'max:255',
                Rule::unique('users')->ignore($userId)
            ],

            'password' => [
                $this->isMethod('POST') ? 'required' : 'nullable',
                'string',
                'min:8',
                'confirmed'
            ]
        ];
    }

    // public function messages()
    // {
    //     return [
    //         'first_name.required' => 'first name is required',
    //         'last_name.required' => 'last name is required',
    //         'email.unique' => 'The email has already been taken.',
    //     ];
    // }




    //  public function messages(): array
    // {
    //     return [
    //         'FirstnameAr.required' => 'حقل الاسم الأول بالعربية مطلوب',
    //         'FirstnameAr.regex' => 'الاسم الأول بالعربية يجب أن يحتوي على أحرف عربية فقط',

    //         'LastnameAr.required' => 'حقل اللقب بالعربية مطلوب',
    //         'LastnameAr.regex' => 'اللقب بالعربية يجب أن يحتوي على أحرف عربية فقط',

    //         'BirthPlaceAr.required' => 'حقل مكان الولادة بالعربية مطلوب',
    //         'BirthPlaceAr.regex' => 'مكان الولادة بالعربية يجب أن يحتوي على أحرف عربية فقط',

    //         'CurrentLocationAr.required' => 'حقل الموقع الحالي بالعربية مطلوب',
    //         'CurrentLocationAr.regex' => 'الموقع الحالي بالعربية يجب أن يحتوي على أحرف عربية فقط',

    //         'FirstnameEn.regex' => 'English first name must contain only English letters',
    //         'LastnameEn.regex' => 'English last name must contain only English letters',
    //         'BirthPlaceEn.regex' => 'English birth place must contain only English letters',
    //         'CurrentLocationEn.regex' => 'English current location must contain only English letters',

    //         'BirthDate.required' => 'حقل تاريخ الميلاد مطلوب',
    //         'BirthDate.before' => 'تاريخ الميلاد يجب أن يكون في الماضي',

    //         'NationalNumber.required' => 'حقل الرقم الوطني مطلوب',
    //         'NationalNumber.unique' => 'الرقم الوطني مسجل مسبقاً',
    //         'NationalNumber.regex' => 'الرقم الوطني يجب أن يحتوي على أرقام فقط',

    //         'IdFrontFace.required' => 'صورة الهوية الأمامية مطلوبة',
    //         'IdFrontFace.image' => 'الملف يجب أن يكون صورة',
    //         'IdFrontFace.max' => 'حجم الصورة يجب ألا يتجاوز 2 ميجابايت',

    //         'IdBackFace.required' => 'صورة الهوية الخلفية مطلوبة',
    //         'IdBackFace.image' => 'الملف يجب أن يكون صورة',
    //         'IdBackFace.max' => 'حجم الصورة يجب ألا يتجاوز 2 ميجابايت',

    //         'ContactNumber.required' => 'حقل رقم الهاتف مطلوب',
    //         'ContactNumber.regex' => 'صيغة رقم الهاتف غير صحيحة',

    //         'Email.required' => 'حقل البريد الإلكتروني مطلوب',
    //         'Email.email' => 'يجب إدخال بريد إلكتروني صحيح',
    //         'Email.unique' => 'البريد الإلكتروني مسجل مسبقاً',

    //         'password.required' => 'حقل كلمة المرور مطلوب',
    //         'password.min' => 'كلمة المرور يجب أن تكون 8 أحرف على الأقل',
    //         'password.confirmed' => 'تأكيد كلمة المرور غير متطابق',
    //         'password.regex' => 'كلمة المرور يجب أن تحتوي على حرف كبير، حرف صغير، رقم، ورمز خاص'
    //     ];
    // }

    // public function attributes(): array
    // {
    //     return [
    //         'FirstnameAr' => 'الاسم الأول (عربي)',
    //         'FirstnameEn' => 'الاسم الأول (إنجليزي)',
    //         'LastnameAr' => 'اللقب (عربي)',
    //         'LastnameEn' => 'اللقب (إنجليزي)',
    //         'MiddlenameAr' => 'اسم الأب (عربي)',
    //         'MiddlenameEn' => 'اسم الأب (إنجليزي)',
    //         'BirthPlaceAr' => 'مكان الولادة (عربي)',
    //         'BirthPlaceEn' => 'مكان الولادة (إنجليزي)',
    //         'BirthDate' => 'تاريخ الميلاد',
    //         'NationalNumber' => 'الرقم الوطني',
    //         'IdFrontFace' => 'صورة الهوية الأمامية',
    //         'IdBackFace' => 'صورة الهوية الخلفية',
    //         'CurrentLocationAr' => 'الموقع الحالي (عربي)',
    //         'CurrentLocationEn' => 'الموقع الحالي (إنجليزي)',
    //         'ContactNumber' => 'رقم الهاتف',
    //         'Email' => 'البريد الإلكتروني',
    //         'password' => 'كلمة المرور',
    //     ];
    // }

}
