<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeacherRequest;
use App\Teacher;
use Exception;
use Illuminate\View\View;

class TeacherController extends Controller
{
    /**
     * @return View
     */
    public function index()
    {
        return view('teacher.index', [
            'teachers' => Teacher::all()
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
     * @param Teacher $teacher
     * @return View
     * @throws Exception
     */
    public function destroy(Teacher $teacher)
    {
        $teacher->delete();

        return view('teacher.index', [
            'message' => 'Teacher deleted'
        ]);
    }
}
