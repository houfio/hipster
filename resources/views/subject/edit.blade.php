@extends('layouts.app')

@section('title', 'Edit subject')

@section('actions')
  <a href="{{ action('SubjectController@index') }}" class="btn btn-light">Cancel</a>
  <x-form-button id="edit-form" type="primary">Edit</x-form-button>
@endsection

@section('content')
  <form method="post" id="edit-form" action="{{ action('SubjectController@update', ['subject' => $subject->id]) }}">
    @csrf
    @method('put')
    <div class="form-row">
      <div class="form-group col-4">
        <label for="name">Name</label>
        <input value="{{ $subject->name }}" type="text" class="form-control" name="name" id="name">
      </div>
      <div class="form-group col-4">
        <label for="credits">Credits</label>
        <input value="{{ $subject->credits }}" type="text" class="form-control" name="credits" id="credits">
      </div>
      <div class="form-group col-md-4">
        <label for="period">Period</label>
        <select class="form-control" name="period" id="period">
          @foreach($periods as $period)
            <option value="{{ $period->id }}" @if($period->id === $subject->period_id) selected @endif>
              Period {{ $period->id }}
            </option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-12">
        <label for="description">Description</label>
        <textarea type="text" class="form-control" name="description" id="description">{{ $subject->description }}</textarea>
      </div>
    </div>
  </form>
  <hr class="mt-0"/>
  <div class="d-flex justify-content-end">
    {{ $teachers->links() }}
  </div>
  <ul class="list-group">
    @foreach($teachers as $teacher)
      <x-list-item :id="$teacher->id">
        <x-slot name="extra">
          <a href="{{ action('TeacherController@edit', ['teacher' => $teacher->id]) }}" class="btn btn-light">Edit</a>
          <x-form-button :id="'toggle-form-' . $teacher->id" type="primary">
            {{ $attached->contains($teacher) ? 'Detach' : 'Attach' }}
          </x-form-button>
          @if($attached->contains($teacher))
            @if($coordinators[$teacher->id])
              <button class="btn btn-primary" disabled>
                Is coordinator
              </button>
            @else
              <x-form-button :id="'toggle-coordinator-' . $teacher->id" type="primary">
                Make coordinator
              </x-form-button>
            @endif
          @endif
        </x-slot>
        {{ $teacher->first_name }} {{ $teacher->last_name }}
        <form
          id="toggle-form-{{ $teacher->id }}"
          method="post"
          action="{{ action('AttachController@toggle', ['teacher' => $teacher->id, 'subject' => $subject->id, 'to' => 'subject']) }}"
          class="d-none"
        >
          @csrf
        </form>
        <form
          id="toggle-coordinator-{{ $teacher->id }}"
          method="post"
          action="{{ action('AttachController@toggle', ['teacher' => $teacher->id, 'subject' => $subject->id, 'to' => 'subject']) }}"
          class="d-none"
        >
          @csrf
        </form>
      </x-list-item>
    @endforeach
  </ul>
@endsection
