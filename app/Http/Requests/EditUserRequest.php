<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.request()->route()->parameters['id']],
            'phone' => ['required', 'numeric', 'unique:users,phone,'.request()->route()->parameters['id']],
        ];
    }
    public function messages()
    {
        return [
            'name.required'=>'Tên không được để trống!',
            'name.string'=>'Tên phải là dạng chuỗi!',
            'name.max'=>'Tên không được vượt quá 255 ký tự!',
            'email.required'=>'Email không được để trống!',
            'email.string'=>'Email phải là dạng chuỗi!',
            'email.email'=>'Email không đúng định dạng!',
            'email.max'=>'Email không được vượt quá 255 ký tự!',
            'email.unique'=>'Email đã tồn tại!',
            'phone.required'=>'Số điện thoại không được để trống!',
            'phone.numeric'=>'Số điện thoại phải là kiểu số!',
            'phone.unique'=>'Số điện thoại đã tồn tại!',
        ];
    }
}
