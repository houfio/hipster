<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'first_name' => 'required|max:30',
            'last_name' => 'required|max:60',
            'email' => 'email|required|max:255',
            'abbreviation' => 'required|max:4'
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute is mandatory!',
            'max' => ':attribute cannot be longer than :max characters!',
            'email' => ':attribute is not a valid email!'
        ];
    }

    public function attributes()
    {
        return [
            'first_name' => 'First name',
            'last_name' => 'Last name',
            'email' => 'E-mail',
            'abbreviation' => 'Abbreviation'
        ];
    }
}
