<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AddBookRequest extends Request
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
            'book_id' => 'required|unique:books',
            'name' => 'required',
            'author' => 'required',
            'publisher' => 'required',
            'cat_id' => 'required',
            'image' => 'required|mimes:jpe,jpeg|max:1024',
            'pages' => 'required',
            'description' => 'required',
            'price' => 'required'
        ];
    }

    public function messages(){
        return [
            'book_id.required' => 'Vui lòng nhập mã sách',
            'book_id.unique' => 'Mã sách đã tồn tại',
            'name.required' => 'Vui lòng nhập tên sách',
            'author.required' => 'Vui lòng nhập tên tác giả',
            'publisher.required' => 'Vui lòng nhập tên nhà xuất bản',
            'cat_id.required' => 'Vui lòng chọn thể loại sách',
            'pages.required' => 'Vui lòng nhập số trang',
            'description.required' => 'Vui lòng nhập mô tả cho sách',
            'price.required' => 'Vui lòng nhập giá sách',
            'image.required' => 'Vui lòng chọn file',
            'image.mimes' => 'Vui lòng chọn ảnh có định dạng .jpe hoặc .jpeg',
            'image.max' => 'Vui lòng chọn file không quá 1MB'
        ];
    }
}
