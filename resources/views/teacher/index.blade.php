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
          <div class="card-header">Teachers</div>
          <div class="card-body">
            <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Search teacher" aria-label="Search teacher">
              </div>
              <div class="btn-group" role="group">
                <button type="button" class="btn btn-secondary">Create</button>
              </div>
            </div>
            <ul class="list-group" style="margin-top: 1rem">
              @foreach($teachers as $teacher)
                <li class="list-group-item">
                  {{ $teacher->first_name }} {{ $teacher->last_name }}
                  <button type="button" class="btn btn-secondary float-right">Edit</button>
                </li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
