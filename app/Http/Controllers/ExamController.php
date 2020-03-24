<?php

namespace App\Http\Controllers;

use App\Exam;
use App\Http\Requests\SearchRequest;
use Exception;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Exam::class, 'Exam');
    }

    public function index(SearchRequest $request)
    {
        $data = $request->validated();
        $page = (int)$request->query('page');
        $pages = Exam::count() / 10;

        if (isset($data['search'])) {
            $exams = Exam::offset($page * 10)
                ->where('name', 'LIKE', "%{$data['search']}%")
                ->orWhere('description', 'LIKE', "%{$data['search']}%")
                ->limit(10)
                ->get();
        } else {
            $exams = Exam::offset($page * 10)->limit(10)->get();
        }

        return view('exam.index', [
            'exams' => $exams,
            'pages' => $pages
        ]);
    }

    public function create()
    {
        return view('exam.create');
    }

    public function store(Request $request)
    {
    }

    public function show(Exam $exam)
    {
        return view('exam.show', [
            'exam' => $exam
        ]);
    }

    public function edit(Exam $exam)
    {
        return view('exam.edit', [
            'exam' => $exam
        ]);
    }

    public function update(Request $request, Exam $exam)
    {
    }

    /**
     * @throws Exception
     */
    public function destroy(Request $request, Exam $exam)
    {
        $exam->delete();
        $request->session()->flash('status', 'This exam was deleted');

        return redirect()->action('TeacherController@index');
    }
}
