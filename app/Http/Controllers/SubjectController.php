<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Http\Requests\SubjectRequest;
use App\Subject;
use Exception;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * @param SearchRequest $request
     * @return View
     */
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

    /**
     * @return View
     */
    public function create()
    {
        return view('subject.create');
    }

    /**
     * @param SubjectRequest $request
     * @return Redirector
     */
    public function store(SubjectRequest $request)
    {
        $data = $request->validated();

        $subject = new Subject();

        $subject->description = $data['description'];
        $subject->name = $data['name'];
        $subject->credits = $data['credits'];

        $subject->save();

        $request->session()->flash('status', "Subject $subject->name was created");
        return redirect('/subject');
    }

    /**
     * @param Subject $subject
     * @return View
     */
    public function show(Subject $subject)
    {
        return view('subject.show', [
            'subject' => $subject
        ]);
    }

    /**
     * @param Subject $subject
     * @return View
     */
    public function edit(Subject $subject)
    {
        return view('subject.edit', [
            'subject' => $subject
        ]);
    }

    /**
     * @param SubjectRequest $request
     * @param Subject $subject
     * @return Redirector
     */
    public function update(SubjectRequest $request, Subject $subject)
    {
        $data = $request->validated();

        $subject->description = $data['description'];
        $subject->name = $data['name'];
        $subject->credits = $data['credits'];

        $subject->save();

        $request->session()->flash('status', "Subject $subject->name was updated");
        return redirect("/subject/$subject->id/edit");
    }

    /**
     * @param Request $request
     * @param Subject $subject
     * @return Redirector
     * @throws Exception
     */
    public function destroy(Request $request, Subject $subject)
    {
        $subject->delete();
        $request->session()->flash('status', "Subject $subject->name was deleted");
        return redirect('/subject');
    }
}
