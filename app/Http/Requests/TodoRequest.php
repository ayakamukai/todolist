<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TodoRequest extends FormRequest
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
            'content' => ['required',
                        'max:30']
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attributeが入力されていません',
            'content.max' => ':max文字以内で入力してください',  
        ];
    }

    public function attributes()
    {
        return [
            'content' => 'Todo'
        ];
    }
}
