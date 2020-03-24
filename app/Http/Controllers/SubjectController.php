<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Http\Requests\SubjectRequest;
use App\Subject;
use App\Teacher;
use Exception;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index(SearchRequest $request)
    {
        $data = $request->validated();
        $page = (int)$request->query('page');
        $pages = Subject::count() / 10;

        if (isset($data['search'])) {
            $subjects = Subject::offset($page * 10)
                ->where('name', 'LIKE', "%{$data['search']}%")
                ->orWhere('credits', 'LIKE', "%{$data['search']}%")
                ->orWhere('description', 'LIKE', "%{$data['search']}%")
                ->limit(10)
                ->get();
        } else {
            $subjects = Subject::offset($page * 10)->limit(10)->get();
        }

        return view('subject.index', [
            'subjects' => $subjects,
            'pages' => $pages
        ]);
    }

    public function create()
    {
        return view('subject.create');
    }

    public function store(SubjectRequest $request)
    {
        $data = $request->validated();

        $subject = new Subject();

        $subject->description = $data['description']->trim();
        $subject->name = $data['name'];
        $subject->credits = $data['credits'];

        $subject->save();

        $request->session()->flash('status', "Subject $subject->name was created");

        return redirect()->action('SubjectController@index');
    }

    public function show(Subject $subject)
    {
        return view('subject.show', [
            'subject' => $subject
        ]);
    }

    public function edit(Subject $subject)
    {
        return view('subject.edit', [
            'subject' => $subject,
            'teachers' => Teacher::get()
        ]);
    }

    public function update(SubjectRequest $request, Subject $subject)
    {
        $data = $request->validated();

        $subject->description = $data['description'];
        $subject->name = $data['name'];
        $subject->credits = $data['credits'];

        $subject->save();

        $request->session()->flash('status', "Subject $subject->name was updated");

        return redirect()->action('SubjectController@edit', ['subject' => $subject->id]);
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
