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
          <div class="card-header">Exams</div>
          <div class="card-body">
            <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
              <div class="input-group">
                <a
                  href="{{ action('HomeController@index') }}"
                  class="btn btn-secondary float-right"
                >
                  Back
                </a>
              </div>
            </div>
            <ul class="list-group" style="margin: 1rem;">
              @foreach($exams as $exam)
                <li class="list-group-item">
                  {{ $exam->name }}
                  <a
                    href="{{ action('ExamController@show', ['exam' => $exam->id]) }}"
                    class="btn btn-secondary float-right"
                  >
                    View
                  </a>
                </li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
