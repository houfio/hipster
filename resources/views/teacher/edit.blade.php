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
          <div class="card-header">Teachers</div>
          <div class="card-body">
            <form method="POST" action="{{ action('TeacherController@update', ['teacher' => $teacher->id]) }}">
              @csrf
              @method('put')
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="first_name">First name</label>
                  <input value="{{ $teacher->first_name }}" type="text" class="form-control" name="first_name" id="first_name">
                </div>
                <div class="form-group col-md-6">
                  <label for="last_name">Last name</label>
                  <input value="{{ $teacher->last_name }}" type="text" class="form-control" name="last_name" id="last_name">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="email">E-mail address</label>
                  <input value="{{ $teacher->email }}" type="email" class="form-control" name="email" id="email">
                </div>
                <div class="form-group col-md-6">
                  <label for="abbreviation">Abbreviation</label>
                  <input value="{{ $teacher->abbreviation }}" type="text" class="form-control" name="abbreviation" id="abbreviation">
                </div>
              </div>
              <input type="submit" class="btn btn-secondary" value="Save">
              <a href="{{ url('/teacher') }}" class="btn btn-secondary">Cancel</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

