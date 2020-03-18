<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchTeacherRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'search' => 'max:255',
        ];
    }

    public function messages()
    {
        return [
            'max' => ':attribute mag niet langer zijn dan :max karakters!'
        ];
    }

    public function attributes()
    {
        return [
            'search' => 'Zoeken',
        ];
    }
}
