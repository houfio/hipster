@extends('layouts.dashboard')

@section('content')
  @if($current)
    <div class="card p-4 border-0 mb-3 d-flex flex-row justify-content-between align-items-center">
      <h1 class="display-4">
        Semester {{ $current }}
      </h1>
    </div>
    <div class="progress bg-white mb-3">
      <div class="progress-bar" role="progressbar" style="width: {{ 100 / $semester['needed'] * $semester['received'] }}%">
        {{ $semester['received'] }}/{{ $semester['needed'] }}
      </div>
    </div>
    @foreach($semester['periods'] as $period)
      <div class="card p-4 border-0 mb-3">
        <h2 class="display-5 mb-4">
          Period {{ $period['period'] }}
        </h2>
        <ul class="list-group">
          @foreach($period['subjects'] as $subject)
            <x-list-item
              :id="$subject->id"
              :edit="action('DashboardController@grades', ['semester' => $current, 'subject' => $subject->id])"
              editLabel="View"
            >
            <span>
              {{ $subject->passed() ? $subject->credits : 0 }}/{{ $subject->credits }} EC | {{ $subject->name }}
              @if($subject->passed())
                <span class="badge badge-success">Passed</span>
              @elseif($subject->graded())
                <span class="badge badge-danger">Not passed</span>
              @endif
            </span>
            </x-list-item>
          @endforeach
        </ul>
      </div>
    @endforeach
  @endif
@endsection
