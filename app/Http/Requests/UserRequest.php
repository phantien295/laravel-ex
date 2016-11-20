<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserRequest extends Request
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
            // 'address' => 'required',
            // 'phone' => 'required|phone',
            'password' => 'required|min:8',
            'repassword' => 'required|same:password'
        ];
    }

    public function messages(){
        return [
            // 'address.required' => 'Vui lòng nhập địa chỉ',
            // 'phone.required' => 'Vui lòng nhập số điện thoại',
            // 'phone.phone' => 'Vui lòng nhập đúng định dạng số điện thoại',
            'password.required' => 'Vui lòng nhập mật khẩu mới',
            'password.min' => 'Mật khẩu ít nhất 8 ký tự',
            'repassword.required' => 'Vui lòng nhập lại mật khẩu',
            'repassword.same' => 'Mật khẩu không khớp',

        ];
    }
}
