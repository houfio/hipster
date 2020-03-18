<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchTeacherRequest;
use App\Http\Requests\TeacherRequest;
use App\Teacher;
use Exception;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * @param SearchTeacherRequest $request
     * @return View
     */
    public function index(SearchTeacherRequest $request)
    {
        $data = $request->validated();
        $page = (int)$request->query('page');
        $pages = Teacher::count() / 10;

        if (isset($data['search'])) {
            $teachers = Teacher::offset($page * 10)
                ->where('first_name', 'LIKE', "%{$data['search']}%")
                ->orWhere('last_name', 'LIKE', "%{$data['search']}%")
                ->orWhere('email', 'LIKE', "%{$data['search']}%")
                ->orWhere('abbreviation', 'LIKE', "%{$data['search']}%")
                ->limit(10)
                ->get();
        } else {
            $teachers = Teacher::offset($page * 10)->limit(10)->get();
        }

        return view('teacher.index', [
            'teachers' => $teachers,
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
     * @return Redirector
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

        $request->session()->flash('status', "Teacher $teacher->first_name $teacher->last_name was created");
        return redirect('/teacher');
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
     * @return Redirector
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

        $request->session()->flash('status', "Teacher $teacher->first_name $teacher->last_name was updated");
        return redirect("/teacher/$teacher->id/edit");
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
