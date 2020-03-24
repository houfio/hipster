@extends('layouts.app')

@section('title', 'Teachers')

@section('actions')
  <a href="{{ action('TeacherController@create') }}" class="btn btn-primary">Create</a>
@endsection

@section('content')
  <div class="d-flex justify-content-end">
    {{ $teachers->links() }}
  </div>
  <ul class="list-group">
    @foreach($teachers as $teacher)
      <x-list-item
        :id="$teacher->id"
        :edit="action('TeacherController@edit', ['teacher' => $teacher->id])"
        :delete="action('TeacherController@destroy', ['teacher' => $teacher->id])"
      >
        {{ $teacher->first_name }} {{ $teacher->last_name }}
      </x-list-item>
    @endforeach
  </ul>
@endsection
