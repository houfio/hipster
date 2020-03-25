@extends('layouts.app')

@section('title', 'Deadlines')

@section('actions')
  <a href="{{ action('DeadlineController@create') }}" class="btn btn-primary">Create</a>
@endsection

@section('content')
  <ul class="list-group">
    @foreach($exams as $exam)
      <li class="list-group-item">
        {{ $exam->name }} | Due on: {{ $exam->due_on }}
        <form method="post" id="form" action="{{ action('DeadlineController@check', ['deadline' => $exam->id]) }}">
          @csrf
          @method('put')
          <div class="form-group col-6">
            <label for="finished">Finished</label>
            <input onclick="document.getElementById('form').submit()" type="checkbox" class="form-control"
                   name="finished" id="finished" @if($exam->finished) checked @endif>
          </div>
        </form>
        <a href="{{ action('DeadlineController@edit', ['deadline' => $exam->id]) }}" class="btn btn-light">Edit</a>
      </li>
    @endforeach
  </ul>
  <div class="btn-group mr-2" role="group">
    @for($i = 0; $i < $pages; $i++)
      <a href="{{ action('DeadlineController@index', ['page' => $i]) }}" class="btn btn-secondary">{{ $i }}</a>
    @endfor
  </div>
@endsection
