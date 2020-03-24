@extends('layouts.app')

@section('title', 'Edit exm')

@section('actions')
  <a href="{{ action('ExamController@index') }}" class="btn btn-light">Cancel</a>
  <x-form-button id="edit-form" type="primary">Edit</x-form-button>
@endsection

@section('content')
  <form method="post" id="edit-form" action="{{ action('ExamController@update', ['exam' => $exam->id]) }}">
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
      <div class="form-group col-md-12">
        <label for="description">Description</label>
        <textarea type="text" class="form-control" name="description" id="description">{{ $exam->description }}</textarea>
      </div>
    </div>
    <div class="form-row">
      <div class="custom-file mx-1 mb-3">
        <input type="file" class="custom-file-input" id="file" name="file"/>
        <label class="custom-file-label" for="file">File</label>
      </div>
      <div class="custom-control custom-checkbox mx-1">
        <input type="checkbox" class="custom-control-input" id="is_assessment" name="is_assessment" @if($exam->is_assessment) checked @endif/>
        <label class="custom-control-label" for="is_assessment">Assessment</label>
      </div>
    </div>
  </form>
@endsection

