@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-8">
        @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
        @endif
        @if($errors)
          @foreach ($errors->all() as $error)
            <div class="alert alert-danger" role="alert">{{ $error }}</div>
          @endforeach
        @endif
        <div class="card">
          <div class="card-header">Create deadline</div>
          <div class="card-body">
            <form method="post" action="{{ action('DeadlineController@store') }}">
              @csrf
              <div class="form-row">
                <div class="form-group col-6">
                  <label for="due_on">Due on</label>
                  <input value="{{ old('due_on') }}" type="datetime-local" class="form-control" name="due_on" id="due_on">
                </div>
                <div class="form-group col-6">
                  <label for="exam">Exam</label>
                  <select id="exam" name="exam" class="form-control">
                    @foreach ($exams as $exam)
                      <option value="{{ $exam->id }}">
                        Subject: {{ $exam->subject->name }} Exam: {{ $exam->name }}
                      </option>
                    @endforeach
                  </select>
                </div>
              </div>
              <input type="submit" class="btn btn-secondary" value="Create">
              <a href="{{ action('DeadlineController@index') }}" class="btn btn-secondary">Cancel</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
