<?php

namespace App\Http\Controllers;

use App\Period;
use App\Subject;
use chillerlan\QRCode\QRCode;
use Closure;

class DashboardController extends Controller
{
    public function index(int $semester = 1)
    {
        $semesterArr = [
            'needed' => 0,
            'received' => 0,
            'periods' => []
        ];
        $dataArr = $this->getSemesters($semester, function ($period, $credits, $received) use ($semester, &$semesterArr) {
            if ($period->semester === $semester) {
                $semesterArr['needed'] += $credits;
                $semesterArr['received'] += $received;
                $semesterArr['periods'][] = [
                    'period' => $period->period,
                    'subjects' => $period->subjects->all()
                ];
            }
        });

        $semesterArr['needed'] = $semesterArr['needed'] ?: 1;

        return view('index', array_merge($dataArr, [
            'semester' => $semesterArr
        ]));
    }

    public function grades(int $semester, int $subject)
    {
        $subjectData = Subject::with('period')->with('exams')->find($subject);
        $dataArr = $this->getSemesters($semester);

        if (!$subjectData) {
            return redirect()->action('DashboardController@index', ['semester' => $semester]);
        }

        return view('grades', array_merge($dataArr, [
            'subject' => $subjectData
        ]));
    }

    private function getSemesters(int $semester = null, ?Closure $fn = null)
    {
        $periods = Period::all();
        $totalNeeded = 0;
        $totalReceived = 0;

        foreach ($periods as $period) {
            $credits = $period->subjects()->sum('credits');
            $received = $period->subjects()->whereHas('exams', function ($query) {
                $query->select('subject_id')->selectRaw('min(grade) as min')->selectRaw('count(*) - count(grade) as count')->groupBy('subject_id')->havingRaw('min >= 5.5 and count = 0');
            })->sum('credits');

            $totalNeeded += $credits;
            $totalReceived += $received;

            if ($fn) {
                $fn($period, $credits, $received);
            }
        }

        $totalNeeded = $totalNeeded ?: 1;

        return [
            'totalNeeded' => $totalNeeded,
            'totalReceived' => $totalReceived,
            'semesters' => Period::groupBy('semester')->pluck('semester', 'semester'),
            'current' => $semester,
            'qr' => (new QRCode())->render(url('/'))
        ];
    }
}
