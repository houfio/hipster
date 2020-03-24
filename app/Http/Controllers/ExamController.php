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
        $this->authorizeResource(Exam::class, 'exam');
    }

    public function index(SearchRequest $request)
    {
        $data = $request->validated();
        $search = isset($data['search']) ? $data['search'] : '';
        $exams = Exam::where('name', 'LIKE', "%$search%")->paginate(10);

        return view('exam.index', [
            'exams' => $exams,
            'search' => $search
        ]);
    }

    public function create()
    {
        return view('exam.create');
    }

    public function store(Request $request)
    {
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
        $request->session()->flash('status', "Exam $exam->name was deleted");

        return redirect()->action('ExamController@index');
    }
}
