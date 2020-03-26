@extends('layouts.app')

@section('title', 'Deadlines')

@section('actions')
  <a dusk="create_deadline" href="{{ action('DeadlineController@create') }}" class="btn btn-primary">Create</a>
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
    @forelse($exams as $exam)
      <x-list-item
        :id="$exam->id"
        :edit="action('DeadlineController@edit', ['deadline' => $exam->id])"
      >
        <x-slot name="extra">
          <form
            method="post"
            id="finished-form-{{ $exam->id }}"
            action="{{ action('DeadlineController@check', ['deadline' => $exam->id]) }}"
          >
            <div class="custom-control custom-checkbox checkbox-group-item">
              <input
                type="checkbox"
                name="finished"
                id="finished-{{ $exam->id }}"
                class="custom-control-input"
                onclick="document.getElementById('finished-form-{{ $exam->id }}').submit()"
                @if($exam->finished) checked @endif
              />
              <label class="custom-control-label" for="finished-{{ $exam->id }}">
                Done
              </label>
            </div>
            @csrf
            @method('put')
          </form>
        </x-slot>
        <span>
          {{ $exam->due_on }} | {{ $exam->subject_name }}
          @if($exam->is_assessment)
            <span class="badge badge-secondary">Assessment</span>
          @endif
        </span>
      </x-list-item>
    @empty
      <div>
        No deadlines found
      </div>
    @endforelse
  </ul>
@endsection
