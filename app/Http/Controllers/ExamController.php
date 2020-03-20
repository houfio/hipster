<?php

namespace App\Http\Controllers;

use App\Exam;
use App\Http\Requests\SearchRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class ExamController extends Controller
{
    /**
     * @param SearchRequest $request
     * @return View
     */
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

    /**
     * @return View
     */
    public function create()
    {
        return view('exam.create');
    }

    public function store(Request $request)
    {
        //
    }

    /**
     * @param Exam $exam
     * @return View
     */
    public function show(Exam $exam)
    {
        return view('exam.show', [
            'exam' => $exam
        ]);
    }

    /**
     * @param Exam $exam
     * @return View
     */
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
     * @param Request $request
     * @param Exam $exam
     * @return Redirector
     * @throws Exception
     */
    public function destroy(Request $request, Exam $exam)
    {
        $exam->delete();
        $request->session()->flash('status', 'This exam was deleted');
        return redirect('/teacher');
    }
}
