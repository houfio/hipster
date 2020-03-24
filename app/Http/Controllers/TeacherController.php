<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeacherRequest;
use App\Teacher;
use Exception;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Teacher::class, 'teacher');
    }

    public function index(Request $request)
    {
        $teachers = Teacher::paginate(10);

        return view('teacher.index', [
            'teachers' => $teachers
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
