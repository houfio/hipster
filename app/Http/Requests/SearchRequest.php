<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
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
            'max' => ':attribute cannot be longer than :max characters!'
        ];
    }

    public function attributes()
    {
        return [
            'search' => 'Search'
        ];
    }
}
