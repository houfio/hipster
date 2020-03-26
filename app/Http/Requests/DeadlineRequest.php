<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeadlineRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'due_on' => 'required|date',
            'exam' => 'required|numeric|exists:exams,id',
            'finished' => 'in:on,off'
        ];
    }

    public function messages()
    {
        return [
            'date' => ':attribute must be a date!',
            'exists' => ':attribute doesn\'t exist in the database!',
            'finished' => ':attribute must be true or false!'
        ];
    }

    public function attributes()
    {
        return [
            'due_on' => 'Due on',
            'exam' => 'Exam',
            'finished' => 'Finished'
        ];
    }
}
