<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherRequest extends FormRequest
{
    public function authorize()
    {
        return false;
    }

    public function rules()
    {
        return [
            'first_name' => 'required|max:30',
            'last_name' => 'required|max:60',
            'email' => 'required|unique:teachers,email|max:255',
            'abbreviation' => 'required|unique:abbreviation,teachers|max:4'
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute is een verplicht veld!',
            'max' => ':attribute mag niet langer zijn dan :max karakters!',
            'unique' => ':attribute bestaat al!'
        ];
    }

    public function attributes()
    {
        return [
            'first_name' => 'Voornaam',
            'last_name' => 'Achternaam',
            'email' => 'E-mailadres',
            'abbreviation' => 'Afkorting'
        ];
    }
}
