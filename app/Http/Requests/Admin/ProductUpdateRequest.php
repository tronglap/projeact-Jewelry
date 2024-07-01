<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
            'name' => 'required',
            'slug' => 'required',
            'price' => 'required|regex:/^\d{1,5}(\.\d{1,2})?$/',
            'promotion' => 'nullable|regex:/^\d{1,6}(\.\d{1,2})?$/',
            'quantity' => 'required',
            'description' => 'required',
            'status' => 'required',
            'product_category_id' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The name is required',
            'slug.required' => 'The slug is required',
            'price.required' => 'The price is required',
            'price.regex' => 'The price must be a valid decimal with up to 6 digits in the integer part and 2 digits in the decimal part.',
            'promotion.regex' => 'The promotion must be a valid decimal with up to 6 digits in the integer part and 2 digits in the decimal part.',
            'quantity.required' => 'The quantity is required',
            'description.required' => 'The description is required',
            'status.required' => 'The status is required',
            'product_category_id.required' => 'The product category is required',
        ];
    }
    protected function withValidator($validator)
    {
        $validator->sometimes('promotion', 'required', function ($input) {
            return $input->sale == '1';
        });
    }
}