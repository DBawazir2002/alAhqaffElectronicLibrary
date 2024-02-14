<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Laravel\Jetstream\Jetstream;
use App\Actions\Fortify\PasswordValidationRules;


class UserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
            'role' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'يرجى اضافة اسم المستخدم',
            'name.min' => 'يجب ان يكون اسم المستخدم يحتوي على ثلاثة احرف او اكثر',
            'email.email' => 'يجب ان يحتوي البريد الالكتروني على @ و . مثل example@example.com',
            'email.required' => 'يرجى اضافة البريد الالكتروني',
            'email.unique' => 'يرجى اختيار بريد اخر فهذا البريد قد اتخياره من قبل مستخدم اخر',
            'password.required' => 'يرجى اضافة كلمة السر',
            'password.min' => 'يجب ان تكون كلمة السر تحتوي على الاقل ثمانية احرف او ارقام',
            'password.confirmed' => 'حقل كلمة السر وحقل تاكيد كلمة السر ليس متطابقان',
            'role.required' => 'يرجى اختيار صلاحيات المستخدم',
        ];
    }
}
