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
          <div class="card-header">Deadlines</div>
          <div class="card-body">
            <ul class="list-group" style="margin: 1rem;">
              @foreach($exams as $exam)
                <li class="list-group-item">
                  {{ $exam->name }} | Due on: {{ $exam->due_on }}
                  <form method="post" id="form" action="{{ action('DeadlineController@update', ['deadline' => $exam->id]) }}">
                    @csrf
                    @method('put')
                    <div class="form-group col-md-6">
                      <label for="due_on">Finished</label>
                      <input onclick="document.getElementById('form').submit()" type="checkbox" class="form-control" name="finished" id="finished" @if($exam->finished) checked @endif>
                    </div>
                  </form>
                </li>
              @endforeach
            </ul>
            <div class="btn-group mr-2" role="group">
              @for($i = 0; $i < $pages; $i++)
                <a href="{{ action('DeadlineController@index', ['page' => $i]) }}" class="btn btn-secondary">{{ $i }}</a>
              @endfor
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
