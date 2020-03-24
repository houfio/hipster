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
    public function __construct()
    {
        $this->authorizeResource(Teacher::class, 'teacher');
    }

    public function index(Request $request)
    {
        $page = (int)$request->query('page');
        $pages = Teacher::count() / 10;
        $teachers = Teacher::offset($page * 10)->limit(10)->get();

        return view('teacher.index', [
            'teachers' => $teachers,
            'pages' => $pages
        ]);
    }

    public function create()
    {
        return view('teacher.create');
    }

    public function store(TeacherRequest $request)
    {
        $data = $request->validated();

        $teacher = new Teacher();

        $teacher->email = $data['email'];
        $teacher->first_name = $data['first_name'];
        $teacher->last_name = $data['last_name'];
        $teacher->abbreviation = $data['abbreviation'];

        $teacher->save();

        $request->session()->flash('status', "Teacher $teacher->first_name $teacher->last_name was created");

        return redirect()->action('TeacherController@index');
    }

    public function show(Teacher $teacher)
    {
        return view('teacher.show', [
            'teacher' => $teacher
        ]);
    }

    public function edit(Teacher $teacher)
    {
        return view('teacher.edit', [
            'teacher' => $teacher
        ]);
    }

    public function update(TeacherRequest $request, Teacher $teacher)
    {
        $data = $request->validated();

        $teacher->email = $data['email'];
        $teacher->first_name = $data['first_name'];
        $teacher->last_name = $data['last_name'];
        $teacher->abbreviation = $data['abbreviation'];

        $teacher->save();

        $request->session()->flash('status', "Teacher $teacher->first_name $teacher->last_name was updated");

        return redirect()->action('TeacherController@edit', ['teacher' => $teacher->id]);
    }

    /**
     * @throws Exception
     */
    public function destroy(Request $request, Teacher $teacher)
    {
        $teacher->delete();
        $request->session()->flash('status', "Teacher $teacher->first_name $teacher->last_name was deleted");

        return redirect()->action('TeacherController@index');
    }
}
