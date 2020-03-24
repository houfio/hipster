<?php

namespace App\Http\Controllers;

use App\Exam;
use App\Http\Requests\CreateDeadlineRequest;
use App\Http\Requests\FinishedRequest;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class DeadlineController extends Controller
{
    /**
     * @throws AuthorizationException
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny');

        $page = (int)$request->query('page');
        $pages = Exam::where('due_on', '!=', null)->count() / 10;
        $exams = Exam::where('due_on', '!=', null)->orderBy('finished', 'asc')->orderBy('due_on', 'asc')->offset($page * 10)->limit(10)->get();

        return view('deadlines.index', [
            'exams' => $exams,
            'pages' => $pages
        ]);
    }

    /**
     * @throws AuthorizationException
     */
    public function create()
    {
        $this->authorize('create');

        return view('deadlines.create', [
            'exams' => Exam::where('due_on', '=', null)->get()
        ]);
    }

    /**
     * @throws AuthorizationException
     */
    public function store(CreateDeadlineRequest $request)
    {
        $this->authorize('create');

        $data = $request->validated();
        /** @var Exam $exam */
        $exam = Exam::find($data['exam']);

        $exam->due_on = $data['due_on'];

        $exam->save();
        $request->session()->flash('status', 'Deadline has been created!');

        return redirect()->action('DeadlineController@index');
    }

    /**
     * @throws AuthorizationException
     */
    public function update(FinishedRequest $request, Exam $deadline)
    {
        $this->authorize('update');

        $data = $request->validated();
        $deadline->finished = $data['finished'] === 'on';
        $deadline->save();

        $request->session()->flash('status', "$deadline->name has been finished!");
        return redirect()->action('DeadlineController@index');
    }
}
