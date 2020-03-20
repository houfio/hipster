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
        @if($errors)
          @foreach ($errors->all() as $error)
            <div class="alert alert-danger" role="alert">{{ $error }}</div>
          @endforeach
        @endif
        <div class="card">
          <div class="card-header">Edit {{ $exam->name }}</div>
          <div class="card-body">
            <form method="post" action="{{ action('ExamController@update', ['exam' => $exam->id]) }}">
              @csrf
              @method('put')
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="name">Name</label>
                  <input value="{{ $exam->name }}" type="text" class="form-control" name="name" id="name">
                </div>
                <div class="form-group col-md-6">
                  <label for="grade">Grade</label>
                  <input value="{{ $exam->grade }}" type="text" class="form-control" name="grade" id="grade">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="start_date">Start date</label>
                  <input value="{{ $exam->start_date }}" type="datetime-local" class="form-control" name="start_date" id="start_date">
                </div>
                <div class="form-group col-md-6">
                  <label for="end_date">End date</label>
                  <input value="{{ $exam->end_date }}" type="datetime-local" class="form-control" name="end_date" id="end_date">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <a href="{{ $exam->file }}">File</a>
                  <input type="file" class="form-control" name="file" id="file">
                </div>
                <div class="form-group col-md-6">
                  <label for="is_assessment">Assessment</label>
                  <input type="checkbox" class="form-control" name="is_assessment" id="is_assessment" @if($exam->is_assessment) checked @endif>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="description">Description</label>
                  <textarea type="text" class="form-control" name="description" id="description">{{ $exam->description }}</textarea>
                </div>
              </div>
              <input type="submit" class="btn btn-secondary" value="Save">
              <a href="{{ url('/exam') }}" class="btn btn-secondary">Cancel</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

