<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeacherRequest;
use App\Teacher;
use Exception;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request)
    {
        $pages = Teacher::all()->count() / 10;
        $page = (int) $request->query('page');

        return view('teacher.index', [
            'teachers' => Teacher::offset($page * 10)->limit(10)->get(),
            'pages' => $pages
        ]);
    }

    /**
     * @return View
     */
    public function create()
    {
        return view('teacher.create');
    }

    /**
     * @param TeacherRequest $request
     * @return View
     */
    public function store(TeacherRequest $request)
    {
        $data = $request->validated();

        $teacher = new Teacher();

        $teacher->email = $data['email'];
        $teacher->first_name = $data['first_name'];
        $teacher->last_name = $data['last_name'];
        $teacher->abbreviation = $data['abbreviation'];

        $teacher->save();

        return view('teacher.index', [
            'message' => 'Teacher created'
        ]);
    }

    /**
     * @param Teacher $teacher
     * @return View
     */
    public function show(Teacher $teacher)
    {
        return view('teacher.show', [
            'teacher' => $teacher
        ]);
    }

    /**
     * @param Teacher $teacher
     * @return View
     */
    public function edit(Teacher $teacher)
    {
        return view('teacher.edit', [
            'teacher' => $teacher
        ]);
    }

    /**
     * @param TeacherRequest $request
     * @param Teacher $teacher
     * @return View
     */
    public function update(TeacherRequest $request, Teacher $teacher)
    {
        $data = $request->validated();

        $teacher->email = $data['email'];
        $teacher->first_name = $data['first_name'];
        $teacher->last_name = $data['last_name'];
        $teacher->abbreviation = $data['abbreviation'];

        $teacher->save();

        return view('teacher.index', [
            'message' => 'Teacher updated'
        ]);
    }

    /**
     * @param Request $request
     * @param Teacher $teacher
     * @return Redirector
     * @throws Exception
     */
    public function destroy(Request $request, Teacher $teacher)
    {
        $teacher->delete();
        $request->session()->flash('status', "Teacher $teacher->first_name $teacher->last_name was deleted");
        return redirect('/teacher');
    }
}
