<?php

namespace App\Http\Controllers;

use App\Subject;
use App\Teacher;
use Illuminate\Http\Request;

class AttachController extends Controller
{
    public function attachTeacher(Request $request, Subject $subject, Teacher $teacher)
    {
        $subject->teachers()->attach($request->get('teacher'));
        $request->session()->flash('status', "$subject->name is now given by $teacher->first_name $teacher->last_name");

        return redirect()->action('SubjectController@edit', ['subject' => $subject->id]);
    }
}
