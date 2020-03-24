<?php

namespace App\Http\Controllers;

use App\Period;
use App\Subject;

class DashboardController extends Controller
{
    public function index()
    {
        $periods = Period::all();
        $semesters = [];

        foreach ($periods as $period) {
            $credits = $period->subjects()->sum('credits');
            $received = 0;

            $period->subjects()->each(function (Subject $subject) use (&$received) {
                $subject->exams()->min('grade') >= 5.5 ?: $received += $subject->credits;
            });

            $semesters[$period->semester]['periods'][$period->period] = [
                'subjects' => $period->subjects()->get(),
                'creditsNeeded' => $credits,
                'creditsReceived' => $received
            ];

            $semester = $semesters[$period->semester];
            $semesters[$period->semester]['creditsNeeded'] = isset($semester['creditsNeeded']) ? $semester['creditsNeeded'] + $credits : $credits;
            $semesters[$period->semester]['creditsReceived'] = isset($semester['creditsReceived']) ? $semester['creditsReceived'] + $received : $received;
        }

        return view('dashboard.home', [
            'semesters' => $semesters
        ]);
    }
}
