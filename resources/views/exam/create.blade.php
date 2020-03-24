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
          <div class="card-header">Create subject</div>
          <div class="card-body">
            <form method="post" action="{{ action('ExamController@store') }}">
              @csrf
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="name">Name</label>
                  <input value="{{ old('name') }}" type="text" class="form-control" name="name" id="name">
                </div>
                <div class="form-group col-md-6">
                  <label for="credits">Credits</label>
                  <input value="{{ old('credits') }}" type="text" class="form-control" name="credits" id="credits">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="description">Description</label>
                  <textarea type="text" class="form-control" name="description" id="description">{{ old('description') }}</textarea>
                </div>
              </div>
              <input type="submit" class="btn btn-secondary" value="Create">
              <a href="{{ action('SubjectController@index') }}" class="btn btn-secondary">Cancel</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
