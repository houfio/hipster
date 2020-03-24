<?php

namespace App\Http\Controllers;

use App\Exam;
use App\Http\Requests\SearchRequest;

class DeadlineController extends Controller
{
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

        return view('deadlines.index', [
            'exams' => $exams,
            'pages' => $pages
        ]);
    }
}
