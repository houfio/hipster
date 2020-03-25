@extends('layouts.app')

@section('title', 'Edit deadline')

@section('actions')
  <a href="{{ action('DeadlineController@index') }}" class="btn btn-light">Cancel</a>
@endsection

@section('content')
  <div class="d-flex justify-content-between">
    {{ $tags->links() }}
  </div>
  <ul class="list-group">
    @foreach($tags as $tag)
      <x-list-item :id="$tag->id">
        <x-slot name="extra">
          <x-form-button :id="'toggle-form-' . $tag->id" type="primary">
            {{ $attached->contains($tag) ? 'Detach' : 'Attach' }}
          </x-form-button>
        </x-slot>
        {{ $tag->name }}
        <form
          id="toggle-form-{{ $tag->id }}"
          method="post"
          action="{{ action('AttachController@toggleTag', ['deadline' => $exam->id, 'tag' => $tag->id]) }}"
          class="d-none"
        >
          @csrf
        </form>
      </x-list-item>
    @endforeach
  </ul>
@endsection
