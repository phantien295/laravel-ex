<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class EditBookRequest extends Request
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
            //'book_id' => 'required|unique:books',
            'name' => 'required',
            'author' => 'required',
            'publisher' => 'required',
            'cat_id' => 'required',
            'pages' => 'required',
            'description' => 'required',
            'price' => 'required',
            'new_image' => 'mimes:jpe,jpeg|max:1024'
        ];
    }
}
