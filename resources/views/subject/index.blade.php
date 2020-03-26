@extends('layouts.app')

@section('title', 'Subjects')

@section('actions')
  <a href="{{ action('SubjectController@create') }}" class="btn btn-primary">Create</a>
@endsection

@section('content')
  <div class="d-flex justify-content-between">
    <form action="{{ action('SubjectController@index') }}">
      <input class="form-control" placeholder="Search" name="search" value="{{ $search }}"/>
    </form>
    {{ $subjects->appends(['search' => $search])->links() }}
  </div>
  <ul class="list-group">
    @forelse($subjects as $subject)
      <x-list-item
        :id="$subject->id"
        :edit="action('SubjectController@edit', ['subject' => $subject->id])"
        :delete="action('SubjectController@destroy', ['subject' => $subject->id])"
        duskSelector="edit-subject"
      >
        {{ $subject->name }}
      </x-list-item>
    @empty
      <div>
        No subjects found
      </div>
    @endforelse
  </ul>
@endsection
