<?php

namespace App\Http\Controllers;

use App\Exam;
use App\Http\Requests\DeadlineRequest;
use App\Http\Requests\SearchRequest;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeadlineController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:view-deadlines');
    }

    public function index(Request $request)
    {
        $sortOptions = ['due_on' => 'Due on', 'subject_name' => 'Subject', 'teacher_name' => 'Teacher', 'is_assessment' => 'Assessment'];
        $orderOptions = ['asc' => 'Ascending', 'desc' => 'Descending'];

        $sort = $this->getOrFirst($request->query('sort'), $sortOptions);
        $order = $this->getOrFirst($request->query('order'), $orderOptions);
        $exams = Exam::with('tags')
            ->join('subjects', 'exams.subject_id', '=', 'subjects.id')
            ->leftJoin('subject_teachers', function ($join) {
                $join->on('subjects.id', '=', 'subject_teachers.subject_id');
                $join->on('subject_teachers.is_coordinator', '=', DB::raw(1));
            })
            ->leftJoin('teachers', 'subject_teachers.teacher_id', '=', 'teachers.id')
            ->select('exams.*', 'subjects.name as subject_name', DB::raw("concat('teacher.first_name', '', 'teacher.last_name') as teacher_name"))
            ->where('due_on', '!=', null)
            ->orderBy($sort, $order)
            ->paginate(10);

        return view('deadlines.index', [
            'exams' => $exams,
            'sort' => $sort,
            'sortOptions' => $sortOptions,
            'order' => $order,
            'orderOptions' => $orderOptions
        ]);
    }

    public function getOrFirst(?string $given, array $options): string
    {
        $arr = array_keys($options);

        if ($given && in_array($given, $arr)) {
            return $given;
        }

        return $arr[0];
    }

    public function create()
    {
        return view('deadlines.create', [
            'exams' => Exam::where('due_on', '=', null)->get()
        ]);
    }

    public function store(DeadlineRequest $request)
    {
        $data = $request->validated();
        $exam = Exam::find($data['exam']);

        $exam->due_on = $data['due_on'];

        $exam->save();
        $request->session()->flash('status', 'Deadline has been created');

        return redirect()->action('DeadlineController@index');
    }

    public function edit(SearchRequest $request, Exam $deadline)
    {
        $data = $request->validated();
        $search = isset($data['search']) ? $data['search'] : '';
        $tags = Tag::where('name', 'LIKE', "%$search%")->paginate(10);
        $attached = $deadline->tags()->get();

        return view('deadlines.edit', [
            'exam' => $deadline,
            'tags' => $tags,
            'attached' => $attached,
            'search' => $search
        ]);
    }

    public function update(DeadlineRequest $request, Exam $deadline)
    {
        $data = $request->validated();

        $deadline->due_on = $data['due_on'];
        $deadline->finished = isset($data['finished']);

        $deadline->save();
        $request->session()->flash('status', "$deadline->name has been updated");

        return redirect()->action('DeadlineController@index');
    }
}
