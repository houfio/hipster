<?php

namespace App\Http\Controllers;

use App\Exam;
use Illuminate\Http\Request;

class DeadlineController extends Controller
{
    public function index(Request $request)
    {
        $page = (int)$request->query('page');
        $pages = Exam::where('due_on', '!=', null)->count() / 10;
        $exams = Exam::where('due_on', '!=', null)->offset($page * 10)->limit(10)->get();

        return view('deadlines.index', [
            'exams' => $exams,
            'pages' => $pages
        ]);
    }
}
