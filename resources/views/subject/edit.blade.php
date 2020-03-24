@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
        @endif
        @if($errors)
          @foreach ($errors->all() as $error)
            <div class="alert alert-danger" role="alert">{{ $error }}</div>
          @endforeach
        @endif
        <div class="card">
          <div class="card-header">Edit {{ $subject->name }}</div>
          <div class="card-body">
            <form method="post" action="{{ action('SubjectController@update', ['subject' => $subject->id]) }}">
              @csrf
              @method('put')
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="name">Name</label>
                  <input value="{{ $subject->name }}" type="text" class="form-control" name="name" id="name">
                </div>
                <div class="form-group col-md-6">
                  <label for="credits">Credits</label>
                  <input value="{{ $subject->credits }}" type="text" class="form-control" name="credits" id="credits">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="description">Description</label>
                  <textarea type="text" class="form-control" name="description" id="description">
                    {{ $subject->description }}
                  </textarea>
                </div>
              </div>
              <input type="submit" class="btn btn-secondary" value="Save">
              <a href="{{ action('SubjectController@index') }}" class="btn btn-secondary">Cancel</a>
            </form>
          </div>
          <ul class="list-group" style="margin-top: 1rem; margin-bottom: 1rem;">
            @foreach($subject->teachers()->get() as $teacher)
              <li class="list-group-item">
                {{ $teacher->first_name }} {{ $teacher->last_name }}
                <form
                  class="float-right"
                  action="{{ action('DetachController@detachTeacher', ['subject' => $subject->id, 'teacher' => $teacher->id]) }}"
                  method="post"
                >
                  @csrf
                  <input class="btn btn-danger" type="submit" value="Detach"/>
                </form>
                <a
                  href="{{ action('TeacherController@edit', ['teacher' => $teacher->id]) }}"
                  class="btn btn-secondary float-right"
                >
                  Edit/View
                </a>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>
@endsection

