@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">View {{ $exam->name }}</div>
          <div class="card-body">
            <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
              <div class="input-group">
                <a
                  href="{{ action('HomeController@exams', ['subject' => $exam->subject->id]) }}"
                  class="btn btn-secondary float-right"
                >
                  Back
                </a>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="name">Name</label>
                <input value="{{ $exam->name }}" type="text" class="form-control" name="name" id="name" disabled>
              </div>
              <div class="form-group col-md-6">
                <label for="grade">Grade</label>
                <input value="{{ $exam->grade }}" type="text" class="form-control" name="grade" id="grade" disabled>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="start_date">Start date</label>
                <input value="{{ $exam->due_on }}" type="datetime-local" class="form-control" name="start_date"
                       id="start_date" disabled>
              </div>
              <div class="form-group col-md-6">
                <label for="is_assessment">Assessment</label>
                <input type="checkbox" class="form-control" name="is_assessment" id="is_assessment"
                       @if($exam->is_assessment) checked @endif disabled>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-12">
                <label for="description">Description</label>
                <textarea type="text" class="form-control" name="description" id="description"
                          disabled>{{ $exam->description }}</textarea>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

