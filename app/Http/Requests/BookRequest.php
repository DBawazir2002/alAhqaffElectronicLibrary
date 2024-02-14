<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
            'title' => 'required|min:2',
            'authorName' => 'required|min:3',
            'category_id' => 'required',
            'cost' => 'required|integer',
            'bookCover' => 'required|mimes:png,jpg,jpeg|max:10000',
            'book' => 'required|mimes:pdf'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'يرجى اضافة عنوان الكتاب',
            'title.min' => 'يجب ان يكون عنوان الكتاب يحتوي على حرفين او اكثر',
            'authorName.min' => 'يجب ان يكون اسم الكاتب يحتوي على ثلاثة احرف او اكثر',
            'authorName.required' => 'يرجى اضافة اسم الكاتب',
            'category_id.required' => 'يرجى اختيار تصنيف الكتاب',
            'cost.required' => 'يرجى ادخال قيمة الكتاب',
            'cost.integer' => 'يرجى ادخال قيمة رقمية',
            'bookCover.required' => 'يرجى اضافة غلاف الكتاب',
            'bookCover.mimes' => 'يجب ان تكون صيغة صور ملف الكتاب PNG او JPG او JPEG',
            'bookCover.max' => 'يجب ان يكون حجم الملف اقل من 10 ميغا',
            'book.required' => 'يرجى اضافة ملف الكتاب',
            'book.mimes' => 'يجب ان تكون صيغة ملف الكتاب PDF فقط',
        ];
    }
}
