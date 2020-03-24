<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet"/>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"/>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
      <span class="navbar-brand">
        {{ config('app.name', 'Laravel') }}
      </span>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbar">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
          <x-navigation-item path="/">
            Home
          </x-navigation-item>
          @can('viewAny', \App\Subject::class)
            <x-navigation-item path="subjects">
              Subjects
            </x-navigation-item>
          @endcan
          @can('viewAny', \App\Teacher::class)
            <x-navigation-item path="teachers">
              Teachers
            </x-navigation-item>
          @endcan
          @can('viewAny', \App\Exam::class)
            <x-navigation-item path="exams">
              Exams
            </x-navigation-item>
          @endcan
        </ul>
        @auth
          <ul class="navbar-nav">
            <x-navigation-item
              path="logout"
              onclick="event.preventDefault(); document.getElementById('logout-form').submit()"
            >
              Logout
            </x-navigation-item>
          </ul>
          <form id="logout-form" action="{{ route('logout') }}" method="post">
            @csrf
          </form>
        @endauth
      </div>
    </nav>
    <main class="py-4">
      <div class="container">
        @yield('content')
      </div>
    </main>
  </body>
</html>
