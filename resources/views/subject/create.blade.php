@extends('layouts.app')

@section('title', 'Create subject')

@section('actions')
  <a href="{{ action('SubjectController@index') }}" class="btn btn-light">Cancel</a>
  <x-form-button id="create-form" type="primary">Create</x-form-button>
@endsection

@section('content')
  <form method="post" id="create-form" action="{{ action('SubjectController@store') }}">
    @csrf
    <div class="form-row">
      <div class="form-group col-4">
        <label for="name">Name</label>
        <input value="{{ old('name') }}" type="text" class="form-control" name="name" id="name"/>
      </div>
      <div class="form-group col-4">
        <label for="credits">Credits</label>
        <input value="{{ old('credits') }}" type="number" class="form-control" name="credits" id="credits"/>
      </div>
      <div class="form-group col-4">
        <label for="period">Period</label>
        <select class="form-control custom-select" name="period" id="period">
          @foreach($periods as $period)
            <option value="{{ $period->id }}">Period {{ $period->id }}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-12 mb-0">
        <label for="description">Description</label>
        <textarea type="text" class="form-control" name="description" id="description">{{ old('description') }}</textarea>
      </div>
    </div>
  </form>
@endsection
