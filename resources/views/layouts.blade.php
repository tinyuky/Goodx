<!doctype html>
<html lang="en">
  <head >
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Gooqx_Assigment</title>

    <!-- Bootstrap JS CSS -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

  </head>

  <body class="">
    @yield('content')
  </body>
</html>
