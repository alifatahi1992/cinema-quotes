<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
        <title>@yield('title')</title>
    <link rel="stylesheet" href="{{URL::to('css/admin.css')}}">
     @yield('styles')
  </head>
  <body>
    @include('includes.admin-header')
    <div class="main">
      @yield('content')
    </div>

  </body>
</html>
