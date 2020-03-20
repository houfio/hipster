@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        {{ decrypt('eyJpdiI6Ikd3RFk1eG9NbnhUajBFZzZpVVlYMnc9PSIsInZhbHVlIjoiK2pycXFPYjNjQndWdC9PSndjZ084U3o1OHVDRjMzVU9sSXVVNWxqUnlzOWhxbFdBTyt5MDVJSHJhSWcyNXdMUyIsIm1hYyI6ImQwYWIxYTdjNzk2M2ZkODU1YzM0NTNjOTVjYjRkMmNkNzVlNGVlZjYxZWY3M2NkM2MzYjU4MmFkNTYzZjRiN2MifQ') }}
        @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
        @endif
        <div class="card">
          <div class="card-header">Dashboard</div>
          <div class="card-body">
            You are a guest!
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
