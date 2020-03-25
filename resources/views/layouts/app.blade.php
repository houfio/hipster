<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet"/>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"/>
  </head>
  <body>
    <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-white">
      <span class="navbar-brand">
        {{ config('app.name', 'Laravel') }}
      </span>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbar">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
          <x-navigation-item path="/">
            Dashboard
          </x-navigation-item>
          @can('viewAny', \App\Teacher::class)
            <x-navigation-item path="teachers">
              Teachers
            </x-navigation-item>
          @endcan
          @can('viewAny', \App\Subject::class)
            <x-navigation-item path="subjects">
              Subjects
            </x-navigation-item>
          @endcan
          @can('viewAny', \App\Exam::class)
            <x-navigation-item path="exams">
              Exams
            </x-navigation-item>
          @endcan
          @can('can-view-deadlines')
            <x-navigation-item path="deadlines">
              Deadlines
            </x-navigation-item>
          @endcan
          @can('viewAny', \App\Tag::class)
            <x-navigation-item path="tags">
              Tags
            </x-navigation-item>
          @endcan
        </ul>
        <ul class="navbar-nav">
          @auth
            <x-navigation-item
              path="logout"
              onclick="event.preventDefault(); document.getElementById('logout-form').submit()"
            >
              Logout
            </x-navigation-item>
            <form id="logout-form" action="{{ action('Auth\LoginController@logout') }}" method="post">
              @csrf
            </form>
          @endauth
          @guest
            <x-navigation-item path="login">
              Login
            </x-navigation-item>
          @endguest
        </ul>
      </div>
    </nav>
    @section('main')
      <main class="mt-5 py-4">
        <div class="container">
          <div class="card p-4 border-0 mb-3 d-flex flex-row justify-content-between align-items-center">
            <h1 class="display-4">
              @yield('title')
            </h1>
            <div class="btn-group">
              @yield('actions')
            </div>
          </div>
          @if (session('status'))
            <div class="alert alert-success">
              {{ session('status') }}
            </div>
          @endif
          @if($errors)
            @foreach ($errors->all() as $error)
              <div class="alert alert-danger">
                {{ $error }}
              </div>
            @endforeach
          @endif
          <div class="card p-4 border-0">
            @yield('content')
          </div>
        </div>
      </main>
    @show
  </body>
</html>
