<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendMailRequest extends FormRequest
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
            'subject' => 'required',
            'user' => 'required',
            'message' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'subject.required' => 'يرجى اضافة موضوع الرسالة',
            'user.required' => 'يرجى اضافة المستخدم ',
            'message.required' => 'يرجى اضافة نص الرسالة',
        ];
    }
}
