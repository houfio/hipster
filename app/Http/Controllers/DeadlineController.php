<?php

namespace App\Http\Controllers;

use App\Exam;
use App\Http\Requests\CreateDeadlineRequest;
use App\Http\Requests\FinishedRequest;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DeadlineController extends Controller
{
    public function index(Request $request)
    {
        Gate::authorize('can-view-deadlines');

        $orderBy = (string)$request->query('sort');
        $sort = (string)$request->query('order');

        $exams = Exam::join('subjects', 'exams.subject_id', '=', 'subjects.id')
            ->join('subject_teachers', 'subjects.id', '=', 'subject_teachers.subject_id')
            ->join('teachers', 'subject_teachers.teacher_id', '=', 'teachers.id')
            ->where('due_on', '!=', null);

        if ($orderBy !== '') {
            $exams->orderBy($orderBy, $sort === '' ? 'asc' : $sort);
        }

        return view('deadlines.index', [
            'exams' => $exams->paginate(10),
            'sort' => $sort,
            'order' => $orderBy
        ]);
    }

    public function create()
    {
        Gate::authorize('can-view-deadlines');

        return view('deadlines.create', [
            'exams' => Exam::where('due_on', '=', null)->get()
        ]);
    }

    public function store(CreateDeadlineRequest $request)
    {
        Gate::authorize('can-view-deadlines');

        $data = $request->validated();
        /** @var Exam $exam */
        $exam = Exam::find($data['exam']);

        $exam->due_on = $data['due_on'];

        $exam->save();
        $request->session()->flash('status', 'Deadline has been created!');

        return redirect()->action('DeadlineController@index');
    }

    public function edit(Exam $deadline)
    {
        return view('deadlines.edit', [
            'exam' => $deadline,
            'tags' => Tag::paginate(10),
            'attached' => $deadline->tags()->get()
        ]);
    }

    public function update(FinishedRequest $request, Exam $deadline)
    {
        Gate::authorize('can-view-deadlines');

        $data = $request->validated();
        $deadline->finished = $data['finished'] === 'on';
        $deadline->save();

        $request->session()->flash('status', "$deadline->name has been finished!");
        return redirect()->action('DeadlineController@index');
    }

    public function check(FinishedRequest $request, Exam $deadline)
    {
        Gate::authorize('can-view-deadlines');

        $data = $request->validated();
        $deadline->finished = $data['finished'] === 'on';
        $deadline->save();

        $request->session()->flash('status', "$deadline->name has been checked!");
        return redirect()->action('DeadlineController@index');
    }
}
