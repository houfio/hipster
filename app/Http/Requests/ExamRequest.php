<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExamRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'description' => 'required|max:255',
            'name' => 'required|max:80',
            'subject' => 'required|numeric',
            'is_assessment' => 'in:on,off',
            'assessment_file' => 'nullable|file|mimes:zip'
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute is mandatory!',
            'max' => ':attribute cannot be longer than :max characters!',
            'numeric' => ':attribute must be a number!',
            'file' => ':attribute must be a file!',
            'mimes' => ':attribute must be a zip file!',
            'in' => ':attribute must be on or off!'
        ];
    }

    public function attributes()
    {
        return [
            'description' => 'Description',
            'name' => 'Name',
            'assessment_file' => 'File',
            'is_assessment' => 'Assessment',
            'subject' => 'Subject'
        ];
    }
}
