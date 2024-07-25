<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email:rfc,dns|unique:users,email,' . $this->route('user'),
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'dob' => 'nullable|date_format:d/m/Y',
            'role' => 'required|in:0,1,2',
            'status' => 'required|in:0,1',
        ];
    }

    /**
     * Get custom error messages for validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'email.unique' => 'Email này đã tồn tại.',
            'email.email' => 'Vui lòng nhập địa chỉ email hợp lệ.',
            'role.in' => 'Vai trò được chọn không hợp lệ.',
            'dob.date_format' => 'Ngày sinh phải có định dạng dd/mm/yyyy.',
            'status.required' => 'Hãy chọn trạng thái!',
            'status.in' => 'Trạng thái không hợp lệ.',
        ];
    }
}
