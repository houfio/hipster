<?php

namespace App\Http\Controllers;

use App\Subject;
use App\Teacher;
use Illuminate\Http\Request;

class DetachSubjectController extends Controller
{
    public function detach(Request $request, Teacher $teacher, Subject $subject)
    {
        $teacher->subjects()->detach($subject->id);
        $request->session()->flash('status', "Teacher $teacher->first_name $teacher->last_name is not giving $subject->name anymore");
        return redirect("/teacher/$teacher->id/edit");
    }
}
