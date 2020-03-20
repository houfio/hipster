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
          <div class="card-header">Exams</div>
          <div class="card-body">
            <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
              <div class="input-group">
                <form class="float-right"
                      action="{{ action('ExamController@index') }}" method="get">
                  @csrf
                  <input type="text" name="search" id="search" class="form-control" placeholder="Search subject" aria-label="Search subject">
                </form>
              </div>
              <div class="btn-group" role="group">
                <a href="{{ url('/exam/create') }}" class="btn btn-secondary">Create</a>
              </div>
            </div>
            <ul class="list-group" style="margin: 1rem;">
              @foreach($exams as $exam)
                <li class="list-group-item">
                  {{ $exam->name }}
                  <form class="float-right"
                        action="{{ action('ExamController@destroy', ['exam' => $exam->id]) }}">
                    @csrf
                    @method('delete')
                    <input class="btn btn-danger" type="submit" value="Delete"/>
                  </form>
                  <a href="{{ url("/exam/$exam->id/edit") }}" class="btn btn-secondary float-right">Edit/View</a>
                </li>
              @endforeach
            </ul>
            <div class="btn-group mr-2" role="group">
              @for($i = 0; $i < $pages; $i++)
                <a href="{{ url("/exam?page=$i") }}" class="btn btn-secondary">{{ $i }}</a>
              @endfor
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
