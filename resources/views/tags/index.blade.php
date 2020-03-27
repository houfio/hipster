@extends('layouts.app')

@section('title', 'Tags')

@section('actions')
  <form method="post" action="{{ action('TagController@store') }}">
    @csrf
    <div class="input-group">
      <input value="{{ old('name') }}" type="text" class="form-control" name="name" id="name" aria-label="Name">
      <button dusk="create_tag" class="btn btn-primary input-group-append" type="submit">
        Create
      </button>
    </div>
  </form>
@endsection

@section('content')
  <div class="d-flex justify-content-between">
    <form action="{{ action('TagController@index') }}">
      <input class="form-control mb-3" placeholder="Search" name="search" value="{{ $search }}"/>
    </form>
    {{ $tags->appends(['search' => $search])->links() }}
  </div>
  <ul class="list-group">
    @forelse($tags as $tag)
      <x-list-item
        :id="$tag->id"
        :delete="action('TagController@destroy', ['tag' => $tag->id])"
        :duskSelector="'tag_' . $tag->name"
      >
        {{ $tag->name }}
      </x-list-item>
    @empty
      <div>
        No tags found
      </div>
    @endforelse
  </ul>
@endsection
