@extends('layouts.app')

@section('title', 'Tags')

@section('actions')
  <form method="post" action="{{ action('TagController@store') }}">
    @csrf
    <input value="{{ old('name') }}" type="text" class="form-control" name="name" id="name" aria-label="Name">
    <input type="submit" class="btn btn-primary" value="Create">
  </form>
@endsection

@section('content')
  <div class="d-flex justify-content-end">
    {{ $tags->links() }}
  </div>
  <ul class="list-group">
    @foreach($tags as $tag)
      <x-list-item
          :id="$tag->id"
          :edit="action('TeacherController@edit', ['teacher' => $tag->id])"
          :delete="action('TagController@destroy', ['tag' => $tag->id])"
      >
        {{ $tag->name }}
      </x-list-item>
    @endforeach
  </ul>
@endsection
