<?php

namespace App\Http\Controllers;

use App\Period;

class HomeController extends Controller
{
    public function index(?int $semester = null)
    {
        $periods = Period::all();
        $semesters = Period::groupBy('semester')->pluck('semester', 'semester');
        $totalNeeded = 0;
        $totalReceived = 0;
        $semesterArr = [
            'semester' => $semester,
            'needed' => 0,
            'received' => 0,
            'periods' => []
        ];

        foreach ($periods as $period) {
            $credits = $period->subjects()->sum('credits');
            $received = $period->subjects()->whereHas('exams', function ($query) {
                $query->select('grade')->groupBy('grade')->havingRaw('min(grade) >= 5.5');
            })->sum('credits');

            $totalNeeded += $credits;
            $totalReceived += $received;

            if ($period->semester === $semester) {
                $semesterArr['needed'] += $credits;
                $semesterArr['received'] += $received;
                $semesterArr['periods'][] = [
                    'period' => $period->period,
                    'subjects' => $period->subjects->all()
                ];
            }
        }

        $totalNeeded = $totalNeeded ?: 1;
        $semesterArr['needed'] = $semesterArr['needed'] ?: 1;

        return view('index', [
            'totalNeeded' => $totalNeeded,
            'totalReceived' => $totalReceived,
            'semester' => $semesterArr,
            'semesters' => $semesters
        ]);
    }
}
