@extends('layouts.app')

@section('title' ,'Create teacher')

@section('actions')
  <a href="{{ action('TeacherController@index') }}" class="btn btn-light">Cancel</a>
  <x-form-button id="create-form" type="primary">Create</x-form-button>
@endsection

@section('content')
  <form method="post" id="create-form" action="{{ action('TeacherController@store') }}">
    @csrf
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="first_name">First name</label>
        <input
          value="{{ old('first_name') }}"
          type="text"
          class="form-control"
          name="first_name"
          id="first_name"
        >
      </div>
      <div class="form-group col-md-6">
        <label for="last_name">Last name</label>
        <input
          value="{{ old('last_name') }}"
          type="text"
          class="form-control"
          name="last_name"
          id="last_name"
        >
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6 mb-0">
        <label for="email">E-mail address</label>
        <input value="{{ old('email') }}" type="email" class="form-control" name="email" id="email">
      </div>
      <div class="form-group col-md-6 mb-0">
        <label for="abbreviation">Abbreviation</label>
        <input
          value="{{ old('abbreviation') }}"
          type="text"
          class="form-control"
          name="abbreviation"
          id="abbreviation"
        >
      </div>
    </div>
  </form>
@endsection
