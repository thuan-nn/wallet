<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisUserRequest extends FormRequest
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
            'name' => 'required|string',
            'number_phone' => 'required|string|unique:users|max:10',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ];
    }
}
