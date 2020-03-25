<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Http\Requests\SubjectRequest;
use App\Period;
use App\Subject;
use App\Teacher;
use Exception;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Subject::class, 'subject');
    }

    public function index(SearchRequest $request)
    {
        $data = $request->validated();
        $search = isset($data['search']) ? $data['search'] : '';
        $subjects = Subject::where('name', 'LIKE', "%$search%")->paginate(10);

        return view('subject.index', [
            'subjects' => $subjects,
            'search' => $search
        ]);
    }

    public function create()
    {
        return view('subject.create', [
            'periods' => Period::all()
        ]);
    }

    public function store(SubjectRequest $request)
    {
        $data = $request->validated();

        $subject = new Subject();

        $subject->description = $data['description'];
        $subject->name = $data['name'];
        $subject->credits = $data['credits'];

        $subject->period()->associate(Period::find($data['period']));
        $subject->save();
        $request->session()->flash('status', "Subject $subject->name was created");

        return redirect()->action('SubjectController@index');
    }

    public function edit(Subject $subject)
    {
        $teachers = Teacher::paginate(10);
        $attached = $subject->teachers()->get();
        $coordinators = array_reduce($attached->all(), function ($previous, $current) {
            $previous[$current->id] = $current->pivot->is_coordinator;

            return $previous;
        }, []);

        return view('subject.edit', [
            'subject' => $subject,
            'teachers' => $teachers,
            'attached' => $attached,
            'coordinators' => $coordinators,
            'periods' => Period::all()
        ]);
    }

    public function update(SubjectRequest $request, Subject $subject)
    {
        $data = $request->validated();

        $subject->description = $data['description'];
        $subject->name = $data['name'];
        $subject->credits = $data['credits'];

        $subject->period()->dissociate();
        $subject->period()->associate(Period::find($data['period']));
        $subject->save();
        $request->session()->flash('status', "Subject $subject->name was updated");

        return redirect()->action('SubjectController@index');
    }

    /**
     * @throws Exception
     */
    public function destroy(Request $request, Subject $subject)
    {
        $subject->delete();
        $request->session()->flash('status', "Subject $subject->name was deleted");

        return redirect()->action('SubjectController@index');
    }
}
