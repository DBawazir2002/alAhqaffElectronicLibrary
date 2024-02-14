<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminProfileRequest extends FormRequest
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
        $user = auth()->user();
        return [
            'name' => 'required|min:3',
            'email' => ['required','email',Rule::unique('users')->ignore($user)],
            'password' => 'sometimes|nullable|min:8|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'يرجى اضافة اسم المستخدم',
            'name.min' => 'يجب ان يكون اسم المستخدم يحتوي على ثلاثة احرف او اكثر',
            'password.min' => 'يجب ان تكون كلمة السر تحتوي على ثمانية احرف او اكثر',
            'email.email' => 'يجب ان يحتوي البريد الالكتروني على @ و . مثل example@example.com',
            'email.required' => 'يرجى اضافة البريد الالكتروني',
            'email.unique' => 'يرجى اختيار بريد اخر فهذا البريد قد اتخياره من قبل مستخدم اخر',
            'password.min' => 'يجب ان تكون كلمة المرور تحتوي على الاقل ثمانية احرف او ارقام',
            'password.required' => 'يرجى اضافة كلمة المرور',
            'password.confirmed' => 'حقل كلمة المرور وحقل تاكيد كلمة المرور ليس متطابقان',
        ];
    }
}
