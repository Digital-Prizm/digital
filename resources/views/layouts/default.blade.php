<!doctype html>
<html>
  <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Digital | Dashboard</title>

   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
@livewireStyles
   <link href="{{ asset('css/app.css') }}" rel="stylesheet">
   <script src="{{ asset('js/app.js') }}"></script>
   <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
  </head>
  
<body>

<div class="h-screen flex overflow-hidden bg-white">
   
@include('includes.left')
      
@yield('content')

@include('includes.footer')



</div>




@livewireScripts
</body>

</html>