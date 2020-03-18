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
          <div class="card-header">Administration</div>
          <div class="card-body">
            <p>You are logged in as administrator!</p>
            <div class="btn-group" role="group" aria-label="Basic example">
              <a href="{{ url('/teacher') }}" class="btn btn-secondary">Teachers</a>
              <a href="{{ url('/subject') }}" class="btn btn-secondary">Classes</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
