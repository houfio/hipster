@extends('layouts.app')

@section('title', 'Edit teacher')

@section('actions')
  <a href="{{ action('TeacherController@index') }}" class="btn btn-light">Cancel</a>
  <x-form-button id="edit-form" type="primary">Edit</x-form-button>
@endsection

@section('content')
  <form method="post" id="edit-form" action="{{ action('TeacherController@update', ['teacher' => $teacher->id]) }}">
    @csrf
    @method('put')
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="first_name">First name</label>
        <input
          value="{{ $teacher->first_name }}"
          type="text"
          class="form-control"
          name="first_name"
          id="first_name"
        >
      </div>
      <div class="form-group col-md-6">
        <label for="last_name">Last name</label>
        <input
          value="{{ $teacher->last_name }}"
          type="text"
          class="form-control"
          name="last_name"
          id="last_name"
        >
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="email">E-mail address</label>
        <input value="{{ $teacher->email }}" type="email" class="form-control" name="email" id="email">
      </div>
      <div class="form-group col-md-6">
        <label for="abbreviation">Abbreviation</label>
        <input
          value="{{ $teacher->abbreviation }}"
          type="text"
          class="form-control"
          name="abbreviation"
          id="abbreviation"
        >
      </div>
    </div>
  </form>
  <div class="d-flex justify-content-end">
    {{ $subjects->links() }}
  </div>
  <ul class="list-group">
    @foreach($subjects as $subject)
      <x-list-item
        :id="$subject->id"
        :edit="action('SubjectController@edit', ['subject' => $subject->id])"
        :delete="action('DetachController@detachSubject', ['subject' => $subject->id, 'teacher' => $teacher->id])"
      >
        {{ $subject->name }}
      </x-list-item>
    @endforeach
  </ul>
@endsection

