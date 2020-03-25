@extends('layouts.app')

@section('title', 'Deadlines')

@section('actions')
  <a href="{{ action('DeadlineController@create') }}" class="btn btn-primary">Create</a>
@endsection

@section('content')
  <div class="d-flex justify-content-between">
    <form id="sort-by" action="{{ action('DeadlineController@index') }}">
      <div class="input-group">
        <select onchange="document.getElementById('sort-by').submit()" class="form-control mr-2" name="sort" id="sort" aria-label="Sort by">
          <option selected disabled>Sort by</option>
          <option value="teachers.first_name">Teacher</option>
          <option value="subjects.name">Subject</option>
          <option value="due_on">Time</option>
          <option value="is_assessment">Category</option>
        </select>
        <select onchange="document.getElementById('sort-by').submit()" class="form-control" name="order" id="order" aria-label="Order">
          <option selected disabled>Order</option>
          <option value="asc">ASC</option>
          <option value="desc">DESC</option>
        </select>
      </div>
    </form>
    {{ $exams->appends(['sort' => $sort, 'order' => $order])->links() }}
  </div>
  <ul class="list-group">
    @foreach($exams as $exam)
      {{ $exam->subject->name }}
      <li class="list-group-item">
        {{ $exam->name }} | Due on: {{ $exam->due_on }}
        <form method="post" id="finished-form" action="{{ action('DeadlineController@check', ['deadline' => $exam->id]) }}">
          @csrf
          @method('put')
          <div class="form-group col-6">
            <label for="finished">Finished</label>
            <input onclick="document.getElementById('finished-form').submit()" type="checkbox" class="form-control"
                   name="finished" id="finished" @if($exam->finished) checked @endif>
          </div>
        </form>
        <a href="{{ action('DeadlineController@edit', ['deadline' => $exam->id]) }}" class="btn btn-light">Edit</a>
      </li>
    @endforeach
  </ul>
@endsection
