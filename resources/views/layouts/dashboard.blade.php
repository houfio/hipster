@extends('layouts.app')

@section('title', 'Dashboard')

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
              href="{{ action('DashboardController@index', ['semester' => $s]) }}"
              class="btn btn-light @if($current === $s) active @endif"
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
      @yield('content')
    </main>
  </div>
@endsection
