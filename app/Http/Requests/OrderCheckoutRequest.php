<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderCheckoutRequest extends FormRequest
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
                'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:15',
                'address' => 'required',
                'email' => 'required|email:rfc,dns',
            ];
        }

        public function messages(): array{
            return [
                'name.required' => 'Trường dữ liệu không được trống',
                'phone.required' => 'Trường dữ liệu không được trống',
                'phone.regex' => 'Số điện thoại không hợp lệ',
                'phone.min' => 'Số điện thoại phải có ít nhất 10 chữ số',
                'phone.max' => 'Số điện thoại không được quá 15 chữ số',
                'address.required' => 'Trường dữ liệu không được trống',
                'email.required' => 'Trường dữ liệu không được trống',
                'email.email' => 'Địa chỉ email không hợp lệ',
            ];
        }

}
