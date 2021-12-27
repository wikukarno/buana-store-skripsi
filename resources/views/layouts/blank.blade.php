<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @include('includes.style')
    <title>@yield('title')</title>
  </head>
  <body>
    @yield('content')
    @stack('before-script')
    @include('includes.script')
    @stack('after-script')
  </body>
</html>
