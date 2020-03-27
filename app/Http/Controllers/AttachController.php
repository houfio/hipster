<?php

namespace App\Http\Controllers;

use App\Exam;
use App\Subject;
use App\SubjectTeacher;
use App\Tag;
use App\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AttachController extends Controller
{
    public function toggleTeacher(Request $request, Teacher $teacher, Subject $subject, string $to)
    {
        Gate::authorize('attach-detach-teacher');

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

    public function toggleTag(Request $request, Exam $deadline, Tag $tag)
    {
        Gate::authorize('attach-detach-tag');

        if ($deadline->tags->contains($tag)) {
            $deadline->tags()->detach($tag);
            $request->session()->flash('status', "$deadline->name now has the tag $tag->name");
        } else {
            $deadline->tags()->save($tag);
            $request->session()->flash('status', "$deadline->name no longer has the tag $tag->name");
        }

        return redirect()->action('DeadlineController@edit', ['deadline' => $deadline->id]);
    }

    public function toggleCoordinator(Request $request, Subject $subject, Teacher $teacher)
    {
        Gate::authorize('attach-detach-teacher');
        $subjectTeachers = SubjectTeacher::where('subject_id', '=', $subject->id)->get();

        foreach ($subjectTeachers as $subjectTeacher) {
            $subjectTeacher->is_coordinator = $subjectTeacher->teacher_id === $teacher->id;
            $subjectTeacher->save();
        }

        $request->session()->flash('status', "$teacher->first_name is now the coordinator of $subject->name");

        return redirect()->action('SubjectController@edit', ['subject' => $subject->id]);
    }
}
