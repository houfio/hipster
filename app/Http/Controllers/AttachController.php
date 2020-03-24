<?php

namespace App\Http\Controllers;

use App\Subject;
use App\Teacher;
use Illuminate\Http\Request;

class AttachController extends Controller
{
    public function toggle(Request $request, Teacher $teacher, Subject $subject, string $to)
    {
        if ($subject->teachers->contains($teacher)) {
            $subject->teachers()->detach($teacher);
            $request->session()->flash('status', "$subject->name is not given by $teacher->first_name $teacher->last_name anymore");
        } else {
            $subject->teachers()->save($teacher);
            $request->session()->flash('status', "$subject->name is now given by $teacher->first_name $teacher->last_name");
        }

        if ($to === 'teacher') {
            return redirect()->action('TeacherController@edit', ['teacher' => $teacher->id]);
        }

        return redirect()->action('SubjectController@edit', ['subject' => $subject->id]);
    }
}
