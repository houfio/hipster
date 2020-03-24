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
            'exam' => 'numeric|exists:exams,id'
        ];
    }

    public function messages()
    {
        return [
            'date' => ':attribute must be a date!',
            'exists' => ':attribute doesn\'t exist in the database!'
        ];
    }

    public function attributes()
    {
        return [
            'due_on' => 'Due on',
            'exam' => 'Exam'
        ];
    }
}
