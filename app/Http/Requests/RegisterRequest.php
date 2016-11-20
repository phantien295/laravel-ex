<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RegisterRequest extends Request
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
            'username' => 'required|unique:users',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:8',
            'repassword' => 'required|same:password',
            'fullname' => 'required',
            'address' => 'required',
            'phone' => 'required|phone'
        ];
    }

    public function messages(){
        return [
            'username.required' => 'Vui lòng nhập tên người dùng',
            'username.unique' => 'Tên người dùng đã được sử dụng',
            'email.required' => 'Vui lòng nhập địa chỉ email',
            'email.unique' => 'Địa chỉ email đã được đăng ký',
            'email.email' => 'Vui lòng nhập đúng định dạng email',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Độ dài mật khẩu nhỏ nhất 8 ký tự',
            'repassword.same' => 'Xác nhận mật khẩu không trùng khớp',
            'repassword.required' => 'Vui lòng nhập xác nhận mật khẩu',
            'fullname.required' => 'Vui lòng nhập họ tên',
            'address.required' => 'Vui lòng nhập địa chỉ',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.phone' => 'Vui lòng nhập đúng định dạng số điện thoại'
        ];
    }
}
