<?php

namespace App\Http\Controllers;

use App\Exam;
use App\Http\Requests\ExamRequest;
use App\Http\Requests\SearchRequest;
use App\Subject;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        $subjects = Subject::all();

        return view('exam.create', [
            'subjects' => $subjects
        ]);
    }

    public function store(ExamRequest $request)
    {
        $data = $request->validated();

        $exam = new Exam();

        $exam->description = $data['description'];
        $exam->name = $data['name'];
        $exam->is_assessment = isset($data['is_assessment']) && $data['is_assessment'] === 'on';

        if (isset($data['assessment_file'])) {
            $exam->file = $request->file('assessment_file')->store('assessments');
        }

        $exam->subject()->associate(Subject::find($data['subject']));
        $exam->save();

        $request->session()->flash('status', 'Exam created');
        return redirect()->action('ExamController@index');
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
