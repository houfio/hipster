@extends('layouts.app')

@section('title', 'Exams')

@section('actions')
  <a href="{{ action('ExamController@create') }}" class="btn btn-primary">Create</a>
@endsection

@section('content')
  <div class="d-flex justify-content-between">
    <form action="{{ action('ExamController@index') }}">
      <input class="form-control" placeholder="Search" name="search" value="{{ $search }}"/>
    </form>
    {{ $exams->appends(['search' => $search])->links() }}
  </div>
  <ul class="list-group">
    @foreach($exams as $exam)
      <x-list-item
        :id="$exam->id"
        :edit="action('ExamController@edit', ['exam' => $exam->id])"
        :delete="action('ExamController@destroy', ['exam' => $exam->id])"
      >
        {{ $exam->name }}
      </x-list-item>
    @endforeach
  </ul>
@endsection
