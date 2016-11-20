<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CategoryRequest extends Request
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
            'cat_id' => 'required|unique:categories|max:20',
            'name' => 'required|unique:categories'
        ];
    }

    public function messages(){
        return [
            'cat_id.required' => 'Vui lòng nhập mã thể loại',
            'cat_id.unique' => 'Mã thể loại đã tồn tại',
            'name.required' => 'Vui lòng nhập tên thể loại',
            'name.unique' => 'Tên thể loại đã tồn tại'
        ];
    }
}
