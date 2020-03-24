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
        <div class="card">
          <div class="card-header">Subjects</div>
          <div class="card-body">
            <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
              <div class="input-group">
                <form
                  method="get"
                  class="float-right"
                  action="{{ action('SubjectController@index') }}"
                >
                  @csrf
                  <input type="text" name="search" id="search" class="form-control" placeholder="Search subject" aria-label="Search subject">
                </form>
              </div>
              <div class="btn-group" role="group">
                <a href="{{ action('SubjectController@create') }}" class="btn btn-secondary">Create</a>
              </div>
            </div>
            <ul class="list-group" style="margin: 1rem;">
              @foreach($subjects as $subject)
                <li class="list-group-item">
                  {{ $subject->name }}
                  <form
                    class="float-right"
                    action="{{ action('SubjectController@destroy', ['subject' => $subject->id]) }}"
                  >
                    @csrf
                    @method('delete')
                    <input class="btn btn-danger" type="submit" value="Delete"/>
                  </form>
                  <a
                    href="{{ action('SubjectController@edit', ['subject' => $subject->id]) }}"
                    class="btn btn-secondary float-right"
                  >
                    Edit
                  </a>
                </li>
              @endforeach
            </ul>
            <div class="btn-group mr-2" role="group">
              @for($i = 0; $i < $pages; $i++)
                <a href="{{ action('SubjectController@index', ['page' => $i]) }}" class="btn btn-secondary">{{ $i }}</a>
              @endfor
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
