<?php

namespace App\Http\Controllers;

use App\Exam;
use App\Http\Requests\CreateDeadlineRequest;
use Illuminate\Http\Request;

class DeadlineController extends Controller
{
    public function index(Request $request)
    {
        $page = (int)$request->query('page');
        $pages = Exam::where('due_on', '!=', null)->count() / 10;
        $exams = Exam::where('due_on', '!=', null)->orderBy('finished', 'asc')->orderBy('due_on', 'asc')->offset($page * 10)->limit(10)->get();

        return view('deadlines.index', [
            'exams' => $exams,
            'pages' => $pages
        ]);
    }

    public function create()
    {
        return view('deadlines.create', [
            'exams' => Exam::where('due_on', '=', null)->get()
        ]);
    }

    public function store(CreateDeadlineRequest $request)
    {
        $data = $request->validated();
        /** @var Exam $exam */
        $exam = Exam::find($data['exam']);

        $exam->due_on = $data['due_on'];

        $exam->save();
        $request->session()->flash('status', 'Deadline has been created!');

        return redirect()->action('DeadlineController@index');
    }
}
