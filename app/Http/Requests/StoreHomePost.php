<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHomePost extends FormRequest
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
            'home_name' => 'required|unique:posts|max:55',
            'home_man' => 'required',
        ];
    }
    public function messages(){
        return [
        'home_name.required'=>'名称必填',
                'home_name.unique'=>'已存在',
                'home_name.max'=>'太长了',
                'home_man.required'=>'必填'
        ];
    }
}
