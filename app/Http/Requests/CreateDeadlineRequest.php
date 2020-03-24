<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateDeadlineRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'due_on' => 'date',
        ];
    }

    public function messages()
    {
        return [
            'date' => ':attribute must be a date!'
        ];
    }

    public function attributes()
    {
        return [
            'due_on' => 'Due on',
        ];
    }
}
