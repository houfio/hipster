@extends('layouts.app')

@section('title', 'Deadlines')

@section('actions')
  <a href="{{ action('DeadlineController@create') }}" class="btn btn-primary">Create</a>
@endsection

@section('content')
  <div class="d-flex justify-content-between">
    <form id="sort-by" action="{{ action('DeadlineController@index') }}">
      <input type="hidden" name="page" value="{{ $exams->currentPage() }}"/>
      <div class="input-group">
        <select onchange="document.getElementById('sort-by').submit()" class="form-control" name="sort" id="sort">
          @foreach($sortOptions as $key => $value)
            <option value="{{ $key }}" @if($sort === $key) selected @endif>
              {{ $value }}
            </option>
          @endforeach
        </select>
        <select
          onchange="document.getElementById('sort-by').submit()"
          class="form-control"
          name="order"
          id="order"
          @if(!$sort) disabled @endif
        >
          @foreach($orderOptions as $key => $value)
            <option value="{{ $key }}" @if($order === $key) selected @endif>
              {{ $value }}
            </option>
          @endforeach
        </select>
      </div>
    </form>
    {{ $exams->appends(['sort' => $sort, 'order' => $order])->links() }}
  </div>
  <ul class="list-group">
    @foreach($exams as $exam)
      <x-list-item
        :id="$exam->id"
        :edit="action('DeadlineController@edit', ['deadline' => $exam->id])"
      >
        {{ $exam->subject_name }}
        <form method="post" id="finished-form" action="{{ action('DeadlineController@check', ['deadline' => $exam->id]) }}">
          @csrf
          @method('put')
          <input
            onclick="document.getElementById('finished-form').submit()"
            type="checkbox"
            name="finished"
            id="finished"
            @if($exam->finished) checked @endif
          />
        </form>
      </x-list-item>
    @endforeach
  </ul>
@endsection
