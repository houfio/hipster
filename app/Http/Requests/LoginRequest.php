<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required|email|string',
            'password' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute is mandatory!',
            'email' => ':attribute must be a email!',
            'string' => ':attribute must be a string!'
        ];
    }

    public function attributes()
    {
        return [
            'email' => 'Email',
            'password' => 'Password'
        ];
    }
}
