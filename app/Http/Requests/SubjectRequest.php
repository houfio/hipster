<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubjectRequest extends FormRequest
{
    private function getSubjectId(): ?int
    {
        return optional($this->route('subject'))->id;
    }

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'description' => 'required|max:255',
            'credits' => 'required|numeric|max:11',
            'name' => "required|unique:subjects,name,{$this->getSubjectId()}|max:45",
            'period' => 'required|numeric|exists:periods,id'
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute is mandatory!',
            'max' => ':attribute cannot be longer than :max characters!',
            'unique' => ':attribute already exists',
            'numeric' => ':attribute must be a number!',
            'exists' => ':attribute does not exist!'
        ];
    }

    public function attributes()
    {
        return [
            'description' => 'Description',
            'credits' => 'Credits',
            'name' => 'Name',
            'period' => 'Period'
        ];
    }
}
