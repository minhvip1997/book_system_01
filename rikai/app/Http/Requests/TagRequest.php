<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
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
        switch($this->method()){
            case 'POST':{
                return [
                    //
                    'name' => 'required',
                    'count' => 'required',
                ];
            }
            case 'PUT':{
                return [
                    //
                    'name' => 'required',
                    'count' => 'required',
                ];
            }
        }
    }

    public function messages(){
        return [
            'name.required' => __('message.name_is_not_null'),
            'count.required' => __('message.count_is_not_null'),
        ];
    }
}
