<?php

namespace App\Http\Controllers;

use App\Subject;
use App\Teacher;
use Illuminate\Http\Request;

class AttachController extends Controller
{
    public function attachTeacher(Request $request, Subject $subject)
    {
        $teacher = Teacher::find($request->get('teacher'));

        if (!$teacher) {
            return redirect()->action('SubjectController@edit', ['subject' => $subject->id]);
        }

        $subject->teachers()->save($teacher);
        $request->session()->flash('status', "$subject->name is now given by $teacher->first_name $teacher->last_name");

        return redirect()->action('SubjectController@edit', ['subject' => $subject->id]);
    }
}
