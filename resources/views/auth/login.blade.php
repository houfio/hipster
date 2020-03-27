@extends('layouts.app')

@section('title', 'Login')

@section('actions')
  <x-form-button duskSelector="do_login" id="login-form" type="primary">Login</x-form-button>
@endsection

@section('content')
  <form method="post" id="login-form" action="{{ action('LoginController@login') }}">
    @csrf
    <div class="form-group">
      <label for="email">Email address</label>
      <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"/>
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input id="password" type="password" class="form-control" name="password"/>
    </div>
    <div class="custom-control custom-checkbox">
      <input type="checkbox" class="custom-control-input" id="remember" {{ old('remember') ? 'checked' : '' }}/>
      <label class="custom-control-label" for="remember">Remember me</label>
    </div>
  </form>
@endsection
