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
            'name' => "required|unique:subjects,name,{$this->getSubjectId()}|max:45"
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute is een verplicht veld!',
            'max' => ':attribute mag niet langer zijn dan :max karakters!',
            'unique' => ':attribute bestaat al!',
            'numeric' => ':attribute moet een nummer zijn!'
        ];
    }

    public function attributes()
    {
        return [
            'description' => 'Beschrijving',
            'credits' => 'Studiepunten',
            'name' => 'Naam'
        ];
    }
}
