<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule; 

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
                        'max:30',
                        Rule::unique('todos')->where('status', 0)]
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attributeが入力されていません',
            'content.max' => ':max文字以内で入力してください',
            'unique' => '未済のTodoと重複しています'
        ];
    }

    public function attributes()
    {
        return [
            'content' => 'Todo'
                ];
    }
}
