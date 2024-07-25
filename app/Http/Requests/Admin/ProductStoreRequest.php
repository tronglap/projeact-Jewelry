<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class ProductStoreRequest extends FormRequest
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
            'price' => 'required|regex:/^\d{1,6}(\.\d{1,2})?$/',
            'promotion' => 'nullable|regex:/^\d{1,6}(\.\d{1,2})?$/|lt:price',
            'quantity' => 'required|integer|min:21',
            'description' => 'required',
            'status' => 'required',
            'product_category_id' => 'required',
            'image_url' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_url_second' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'sale' => 'nullable|boolean',
        ];
    }


    public function messages(): array
    {
        return [
            'name.required' => 'Tên sản phẩm không được trống',
            'name.min' => 'Tên tối thiểu 3 ký tự!',
            'name.max' => 'Tên tối đa 255 ký tự!',
            'slug.required' => 'Slug không được trống',
            'price.required' => 'Giá sản phẩm không được trống',
            'price.regex' => 'Giá sản phẩm phải là số thập phân hợp lệ với tối đa 6 chữ số ở phần nguyên và 2 chữ số ở phần thập phân.',
            'promotion.regex' => 'Khuyến mãi phải là số thập phân hợp lệ với tối đa 6 chữ số ở phần nguyên và 2 chữ số ở phần thập phân.',
            'promotion.lt' => 'Giá khuyến mãi phải nhỏ hơn giá sản phẩm.',
            'quantity.required' => 'Số lượng không được trống',
            'quantity.min' => 'Số lượng phải lớn hơn 20',
            'description.required' => 'Mô tả không được trống',
            'status.required' => 'Trạng thái không được trống',
            'product_category_id.required' => 'Danh mục sản phẩm không được trống',
            'image_url.required' => 'Hình ảnh không được trống',
            'image_url.image' => 'Tệp phải là hình ảnh',
            'image_url.mimes' => 'Hình ảnh phải có định dạng jpeg, png, jpg, hoặc gif',
            'image_url.max' => 'Hình ảnh phải có kích thước tối đa là 2MB',
            'image_url_second.required' => 'Hình ảnh thứ hai không được trống',
            'image_url_second.image' => 'Tệp phải là hình ảnh',
            'image_url_second.mimes' => 'Hình ảnh thứ hai phải có định dạng jpeg, png, jpg, hoặc gif',
            'image_url_second.max' => 'Hình ảnh thứ hai phải có kích thước tối đa là 2MB',
            'sale.boolean' => 'Khuyến mãi phải là đúng hoặc sai',
            'salePercent.numeric' => 'Phần trăm giảm giá phải là số.',
            'salePercent.min' => 'Phần trăm giảm giá phải ít nhất là 0%.',
            'salePercent.max' => 'Phần trăm giảm giá không được vượt quá 100%.',

        ];
    }

    protected function withValidator($validator)
    {
        $validator->sometimes('promotion', 'required', function ($input) {
            return $input->sale == '1';
        });

        $validator->sometimes('salePercent', 'required|numeric|min:0|max:100', function ($input) {
            return $input->sale == '1';
        });

        $validator->after(function ($validator) {
            if ($this->sale == '1') {
                if ($this->promotion >= $this->price) {
                    $validator->errors()->add('promotion', 'Giá khuyến mãi phải nhỏ hơn giá sản phẩm.');
                }
            } else {
                $this->merge(['salePercent' => null, 'promotion' => null]);
            }
        });
    }
}
