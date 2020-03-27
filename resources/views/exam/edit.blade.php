@extends('layouts.app')

@section('title', 'Edit exam')

@section('actions')
  <a href="{{ action('ExamController@index') }}" class="btn btn-light">Cancel</a>
  <x-form-button :id="'edit-form'" type="primary">Edit</x-form-button>
@endsection

@section('content')
  <form method="post" enctype="multipart/form-data" id="edit-form"
        action="{{ action('ExamController@update', ['exam' => $exam->id]) }}">
    @csrf
    @method('put')
    <div class="form-row">
      <div class="form-group col-4">
        <label for="name">Name</label>
        <input value="{{ $exam->name }}" type="text" class="form-control" name="name" id="name">
      </div>
      <div class="form-group col-4">
        <label for="grade">Grade</label>
        <input value="{{ $exam->grade }}" type="number" class="form-control" name="grade" id="grade">
      </div>
      <div class="form-group col-4">
        <label for="subject">Subject</label>
        <select class="form-control" name="subject" id="subject">
          @foreach($subjects as $subject)
            <option value="{{ $subject->id }}"
                    @if($subject->id === $exam->subject_id) selected @endif>{{ $subject->name }}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-12">
        <label for="description">Description</label>
        <textarea type="text" class="form-control" name="description"
                  id="description">{{ $exam->description }}</textarea>
      </div>
    </div>
    <div class="form-row">
      <div class="custom-file mx-1 mb-3">
        <input type="file" class="custom-file-input" id="assessment_file" name="assessment_file"/>
        <label class="custom-file-label" for="assessment_file">File</label>
      </div>
      @if($exam->file)
        <div class="custom-file mx-1 mb-3">
          <a href="/{{ $exam->file }}" download>Download file</a>
        </div>
      @endif
      <div class="custom-control custom-checkbox mx-1">
        <input
            type="checkbox"
            class="custom-control-input"
            id="is_assessment"
            name="is_assessment"
            @if($exam->is_assessment) checked @endif
        />
        <label class="custom-control-label" for="is_assessment">Assessment</label>
      </div>
    </div>
  </form>
@endsection

