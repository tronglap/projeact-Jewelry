<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogCategoriesStoreRequest extends FormRequest
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
            'name' => 'required|min:3|max:255',
            'slug' => 'required',
            'status' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Tên buộc phải nhập!',
            'name.min' => 'Tên tối thiểu 3 ký tự!',
            'name.max' => 'Tên tối đa 255 ký tự!',
            'slug.required' => 'Slug buộc phải nhập!',
            'status.required' => 'Trạng thái buộc phải nhập!',
        ];
    }
}
