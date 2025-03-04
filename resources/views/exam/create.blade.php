@extends('layouts.app')

@section('title', 'Create exam')

@section('actions')
  <a href="{{ action('ExamController@index') }}" class="btn btn-light">Cancel</a>
  <x-form-button id="create-form" type="primary">Create</x-form-button>
@endsection

@section('content')
  <form method="post" enctype="multipart/form-data" id="create-form" action="{{ action('ExamController@store') }}">
    @csrf
    <div class="form-row">
      <div class="form-group col-4">
        <label for="name">Name</label>
        <input value="{{ old('name') }}" type="text" class="form-control" name="name" id="name"/>
      </div>
      <div class="form-group col-4">
        <label for="grade">Grade</label>
        <input value="{{ old('grade') }}" type="number" class="form-control" name="grade" id="grade">
      </div>
      <div class="form-group col-4">
        <label for="subject">Subject</label>
        <select class="form-control custom-select" name="subject" id="subject">
          @foreach($subjects as $subject)
            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-12">
        <label for="description">Description</label>
        <textarea type="text" class="form-control" name="description" id="description">{{ old('description') }}</textarea>
      </div>
    </div>
    <div class="form-row">
      <div class="custom-file mx-1 mb-3" id="file_wrapper" style="display: none">
        <input type="file" class="custom-file-input" id="assessment_file" name="assessment_file"/>
        <label class="custom-file-label" for="assessment_file">File</label>
      </div>
      <div class="custom-control custom-checkbox mx-1">
        <input
          type="checkbox"
          class="custom-control-input"
          id="is_assessment"
          name="is_assessment"
          onchange="document.getElementById('file_wrapper').style.display = this.checked ? 'block' : 'none'"
        />
        <label class="custom-control-label" for="is_assessment">Assessment</label>
      </div>
    </div>
  </form>
@endsection
