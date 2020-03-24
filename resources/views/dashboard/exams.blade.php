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
            <ul class="list-group" style="margin: 1rem;">
              @foreach($exams as $exam)
                <li class="list-group-item">
                  {{ $exam->name }}
                </li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
