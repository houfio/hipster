@extends('layouts.app')

@section('title', 'Exams')

@section('actions')
  <a href="{{ action('ExamController@create') }}" class="btn btn-primary">Create</a>
@endsection

@section('content')
  <div class="d-flex justify-content-between">
    <form action="{{ action('ExamController@index') }}">
      <input class="form-control mb-3" placeholder="Search" name="search" value="{{ $search }}"/>
    </form>
    {{ $exams->appends(['search' => $search])->links() }}
  </div>
  <ul class="list-group">
    @forelse($exams as $exam)
      <x-list-item
        :id="$exam->id"
        :edit="action('ExamController@edit', ['exam' => $exam->id])"
        :delete="action('ExamController@destroy', ['exam' => $exam->id])"
      >
        {{ $exam->subject->name }} | {{ $exam->name }}
      </x-list-item>
    @empty
      <div>
        No exams found
      </div>
    @endforelse
  </ul>
@endsection
