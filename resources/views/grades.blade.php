@extends('layouts.dashboard')

@section('content')
  <div class="card p-4 border-0 mb-3 d-flex flex-row justify-content-between align-items-center">
    <h1 class="display-4">
      Period {{ $subject->period->period }}
    </h1>
  </div>
  <div class="card p-4 border-0 mb-3">
    <h2 class="display-5 mb-4">
      {{ $subject->name }}
    </h2>
    <ul class="list-group">
      @forelse($subject->exams as $exam)
        <x-list-item :id="$exam->id">
          {{ $exam->name }}
          @if($exam->grade)
            <span class="badge @if($exam->passed()) badge-success @else badge-danger @endif">
              {{ $exam->grade }}
            </span>
          @else
            <span class="badge badge-secondary">
              Not graded
            </span>
          @endif
        </x-list-item>
      @empty
        <div>
          No exams planned
        </div>
      @endforelse
    </ul>
  </div>
@endsection
