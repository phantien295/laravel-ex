<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SaleoffRequest extends Request
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
            'book_id' => 'required|exists:books',
            // 'repassword' => 'required|same:password'
        ];
    }

    public function messages(){
        return [
            'book_id.required' => 'Vui lòng nhập mã sách',
            'book_id.exists' => 'Mã sách không tồn tại'
        ];
    }
}
