<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'categoryName' => 'required|min:2'
        ];
    }

    public function messages()
    {
        return [
            'categoryName.required' => 'يرجى اضافة اسم التصنيف',
            'categoryName.min' => 'يجب ان يكون اسم التصنيف يحتوي على حرفين او اكثر',
        ];
    }
}
