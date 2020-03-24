@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
        @endif
        <div class="card">
          <div class="card-header">Dashboard</div>
          <div class="card-body">
            <span>EC's: {{ $creditsReceived }}/{{ $creditsNeeded }}</span>
            <div class="progress mb-4">
              <div class="progress-bar" role="progressbar" style="width: {{ 100 / $creditsNeeded * $creditsReceived }}%"
                   aria-valuenow="{{ $creditsReceived }}" aria-valuemin="0" aria-valuemax="{{ $creditsNeeded }}"></div>
            </div>
            <div class="accordion" id="accordionSemesters">
              @foreach($semesters as $semesterKey => $semester)
                <div class="card">
                  <div class="card-header" id="headingSemester{{ $semesterKey }}">
                    <h2 class="mb-0">
                      <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                              data-target="#collapseSemester{{ $semesterKey }}"
                              aria-expanded="false" aria-controls="collapseSemester{{ $semesterKey }}">
                        Semester {{ $semesterKey }}
                      </button>
                    </h2>
                  </div>
                  <div id="collapseSemester{{ $semesterKey }}" class="collapse"
                       aria-labelledby="headingSemester{{ $semesterKey }}"
                       data-parent="#accordionSemesters">
                    <div class="card-body">
                      <span>EC's: {{ $semester['creditsReceived'] }}/{{ $semester['creditsNeeded'] }}</span>
                      <div class="progress mb-4">
                        <div class="progress-bar" role="progressbar"
                             style="width: {{ 100 / $semester['creditsNeeded'] * $semester['creditsReceived'] }}%"
                             aria-valuenow="{{ $semester['creditsReceived'] }}" aria-valuemin="0"
                             aria-valuemax="{{ $semester['creditsNeeded'] }}"></div>
                      </div>
                      <div class="accordion" id="accordionPeriods">
                        @foreach($semester['periods'] as $periodKey => $period)
                          <div class="card">
                            <div class="card-header" id="headingPeriod{{ $periodKey }}">
                              <h2 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                        data-target="#collapsePeriod{{ $periodKey }}"
                                        aria-expanded="false" aria-controls="collapsePeriod{{ $periodKey }}">
                                  Period {{ $periodKey }}
                                </button>
                              </h2>
                            </div>
                            <div id="collapsePeriod{{ $periodKey }}" class="collapse"
                                 aria-labelledby="headingPeriod{{ $periodKey }}"
                                 data-parent="#accordionPeriods">
                              <div class="card-body">
                                <span>EC's: {{ $period['creditsReceived'] }}/{{ $period['creditsNeeded'] }}</span>
                                <div class="progress mb-4">
                                  <div class="progress-bar" role="progressbar"
                                       style="width: {{ 100 / $period['creditsNeeded'] * $period['creditsReceived'] }}%"
                                       aria-valuenow="{{ $period['creditsReceived'] }}" aria-valuemin="0"
                                       aria-valuemax="{{ $period['creditsNeeded'] }}"></div>
                                </div>
                                <table class="table">
                                  <thead>
                                    <tr>
                                      <th scope="col">Subject</th>
                                      <th scope="col">EC's</th>
                                      <th scope="col">Passed</th>
                                      <th scope="col">Exams</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @foreach($period['subjects'] as $subject)
                                      <tr>
                                        <th scope="row">{{ $subject->name }}</th>
                                        <td>{{ $subject->exams()->min('grade') >= 5.5 ? $subject->credits : 0 }}/{{ $subject->credits }}</td>
                                        @if($subject->exams()->min('grade') >= 5.5)
                                          <td style="color: green;">Passed</td>
                                        @elseif($subject->exams()->min('grade'))
                                          <td style="color: red;">Not passed</td>
                                        @else
                                          <td>No exams graded yet</td>
                                        @endif
                                        <td><a href="{{ action('HomeController@exams', ['subject' => $subject->id]) }}">Show exams ></a></td>
                                      </tr>
                                    @endforeach
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                        @endforeach
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
