<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FinishedRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'finished' => 'in:on,off',
        ];
    }

    public function messages()
    {
        return [
            'in' => ':attribute must be true or false!'
        ];
    }

    public function attributes()
    {
        return [
            'finished' => 'Finished'
        ];
    }
}
