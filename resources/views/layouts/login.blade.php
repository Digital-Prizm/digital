  <!doctype html>
  <html>
  <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Digital | Login </title>

   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
@livewireStyles
   <link href="{{ asset('css/app.css') }}" rel="stylesheet">
   <script src="{{ asset('js/app.js') }}"></script>
  </head>
  <body>
@yield('content')


@livewireScripts
  
