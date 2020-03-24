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
                      <p>EC's needed: {{ $semester['creditsNeeded'] }}</p>
                      <p>EC's received: {{ $semester['creditsReceived'] }}</p>
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
                                @foreach($period['subjects'] as $subject)
                                  <p>{{ $subject->name }}</p>
                                @endforeach
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
