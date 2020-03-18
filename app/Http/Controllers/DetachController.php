<?php

namespace App\Http\Controllers;

use App\Subject;
use App\Teacher;
use Illuminate\Http\Request;

class DetachController extends Controller
{
    public function detachSubject(Request $request, Teacher $teacher, Subject $subject)
    {
        $teacher->subjects()->detach($subject->id);
        $request->session()->flash('status', "Teacher $teacher->first_name $teacher->last_name is not giving $subject->name anymore");
        return redirect("/teacher/$teacher->id/edit");
    }

    public function detachTeacher(Request $request, Subject $subject, Teacher $teacher)
    {
        $subject->teachers()->detach($teacher->id);
        $request->session()->flash('status', "$subject->name is not given by $teacher->first_name $teacher->last_name anymore");
        return redirect("/subject/$subject->id/edit");
    }
}
