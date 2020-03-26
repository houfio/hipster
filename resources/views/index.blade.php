@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
  <div class="progress bg-white mb-3">
    <div class="progress-bar" role="progressbar"
         style="width: {{ 100 / $semester['needed'] * $semester['received'] }}%">
      {{ $semester['received'] }}/{{ $semester['needed'] }}
    </div>
  </div>
  @foreach($semester['periods'] as $period)
    <div class="card p-4 border-0 mb-3">
      <h2 class="display-5 mb-4">
        Period {{ $period['period'] }}
      </h2>
      <table class="table mb-0">
        <thead>
          <tr>
            <th>Subject</th>
            <th>Credits</th>
            <th>Passed</th>
          </tr>
        </thead>
        <tbody>
          @foreach($period['subjects'] as $subject)
            <tr>
              <th>{{ $subject->name }}</th>
              <td>{{ $subject->hasSufficientGrades() ? $subject->credits : 0 }}/{{ $subject->credits }}</td>
              @if($subject->hasSufficientGrades())
                <td class="text-success">Passed</td>
              @elseif($subject->hasGrades())
                <td class="text-danger">Not passed</td>
              @else
                <td>Not graded</td>
              @endif
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  @endforeach
@endsection

@section('main')
  <div class="d-flex mt-5 pt-2">
    <aside class="w-sidebar">
      <div class="position-fixed w-sidebar vh-100 bg-white d-flex flex-column align-items-stretch py-4 text-center">
        <h1 class="display-5">
          {{ config('app.name', 'Laravel') }}
        </h1>
        <div class="progress mx-3 mt-3 mb-4">
          <div class="progress-bar" role="progressbar" style="width: {{ 100 / $totalNeeded * $totalReceived }}%">
            {{ $totalReceived }}/{{ $totalNeeded }}
          </div>
        </div>
        <div class="btn-group-vertical mx-3">
          @foreach($semesters as $s)
            <a
              href="{{ action('HomeController@index', ['semester' => $s]) }}"
              class="btn btn-light @if($semester['semester'] === $s) active @endif"
            >
              Semester {{ $s }} (Y{{ ceil($s / 2) }})
            </a>
          @endforeach
        </div>
        <div class="flex-grow-1"></div>
        <img src="{{ $qr }}" class="w-100 mb-4"/>
      </div>
    </aside>
    <main class="d-flex flex-column flex-grow-1 p-3">
      @if($semester['semester'])
        <div class="card p-4 border-0 mb-3 d-flex flex-row justify-content-between align-items-center">
          <h1 class="display-4">
            Semester {{ $semester['semester'] }}
          </h1>
        </div>
        @yield('content')
      @endif
    </main>
  </div>
@endsection
