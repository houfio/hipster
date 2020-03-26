@extends('layouts.app')

@section('title', 'Create deadline')

@section('actions')
  <a href="{{ action('DeadlineController@index') }}" class="btn btn-light">Cancel</a>
  <x-form-button id="create-form" type="primary">Create</x-form-button>
@endsection

@section('content')
  <form method="post" id="create-form" action="{{ action('DeadlineController@store') }}">
    @csrf
    <div class="form-row">
      <div class="form-group col-6 mb-0">
        <label for="due_on">Due on</label>
        <input value="{{ old('due_on') }}" type="datetime-local" class="form-control" name="due_on" id="due_on">
      </div>
      <div class="form-group col-6 mb-0">
        <label for="exam">Exam</label>
        <select id="exam" name="exam" class="form-control">
          @foreach ($exams as $exam)
            <option value="{{ $exam->id }}" @if($exam->id === old('exam')) selected @endif>
              Subject: {{ $exam->subject->name }} Exam: {{ $exam->name }}
            </option>
          @endforeach
        </select>
      </div>
    </div>
  </form>
@endsection
