@extends('layouts.app')

@section('title', 'Create exam')

@section('actions')
  <a href="{{ action('ExamController@index') }}" class="btn btn-light">Cancel</a>
  <x-form-button id="create-form" type="primary">Create</x-form-button>
@endsection

@section('content')
  <form method="post" id="create-form" action="{{ action('ExamController@store') }}">
    @csrf
    <div class="form-row">
      <div class="form-group col-md-4">
        <label for="name">Name</label>
        <input value="{{ old('name') }}" type="text" class="form-control" name="name" id="name"/>
      </div>
      <div class="form-group col-md-4">
        <label for="credits">Credits</label>
        <input value="{{ old('credits') }}" type="number" class="form-control" name="credits" id="credits"/>
      </div>
      <div class="form-group col-md-4">
        <label for="subject">Subject</label>
        <select class="form-control" name="subject" id="subject">
          @foreach($subjects as $subject)
            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-12 mb-0">
        <label for="description">Description</label>
        <textarea type="text" class="form-control" name="description" id="description">{{ old('description') }}</textarea>
      </div>
    </div>
  </form>
@endsection
