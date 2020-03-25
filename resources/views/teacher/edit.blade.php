@extends('layouts.app')

@section('title', 'Edit teacher')

@section('actions')
  <a href="{{ action('TeacherController@index') }}" class="btn btn-light">Cancel</a>
  <x-form-button :id="'edit-form'" type="primary">Edit</x-form-button>
@endsection

@section('content')
  <form method="post" id="edit-form" action="{{ action('TeacherController@update', ['teacher' => $teacher->id]) }}">
    @csrf
    @method('put')
    <div class="form-row">
      <div class="form-group col-6">
        <label for="first_name">First name</label>
        <input
          value="{{ $teacher->first_name }}"
          type="text"
          class="form-control"
          name="first_name"
          id="first_name"
        >
      </div>
      <div class="form-group col-6">
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
      <div class="form-group col-6">
        <label for="email">Email address</label>
        <input value="{{ $teacher->email }}" type="email" class="form-control" name="email" id="email">
      </div>
      <div class="form-group col-6">
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
  <hr class="mt-0"/>
  <div class="d-flex justify-content-between">
    <form action="{{ action('TeacherController@edit', ['teacher' => $teacher->id]) }}">
      <input class="form-control" placeholder="Search" name="search" value="{{ $search }}"/>
    </form>
    {{ $subjects->appends(['search' => $search])->links() }}
  </div>
  <ul class="list-group">
    @foreach($subjects as $subject)
      <x-list-item :id="$subject->id">
        <x-slot name="extra">
          <a href="{{ action('SubjectController@edit', ['subject' => $subject->id]) }}" class="btn btn-light">Edit</a>
          <x-form-button :id="'toggle-form-' . $subject->id" type="primary">
            {{ $attached->contains($subject) ? 'Detach' : 'Attach' }}
          </x-form-button>
        </x-slot>
        {{ $subject->name }}
        <form
          id="toggle-form-{{ $subject->id }}"
          method="post"
          action="{{ action('AttachController@toggle', ['teacher' => $teacher->id, 'subject' => $subject->id, 'to' => 'teacher']) }}"
          class="d-none"
        >
          @csrf
        </form>
      </x-list-item>
    @endforeach
  </ul>
@endsection
