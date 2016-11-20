<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ContactRequest extends Request
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
            'email' => 'required|email',
            'message' => 'required'
        ];
    }

    public function messages(){
        return [
            'email.required' => "Vui lòng nhập địa chỉ email",
            'email.email' => "Vui lòng nhập đúng định dạng email",
            'message.required' => "Vui lòng nhập nội dung"
        ];
    }
}
