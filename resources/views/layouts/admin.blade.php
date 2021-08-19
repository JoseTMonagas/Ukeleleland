<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/sc-2.0.1/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/sc-2.0.1/datatables.min.js"></script>
  </head>

  <body>
    <nav class="navbar navbar-dark bg-primary">
      <img class="img-fluid" alt="" src="{{ asset('img/logo-ukeleleland-black.png') }}" style="max-width: 8rem" />
      <ul class="navbar-nav mr-auto d-flex flex-row">
        <li class="nav-item mx-5">
          <a class="nav-link" href="{{ route('home') }}">Pagina Principal</a>
        </li>
        <li class="nav-item mx-5">
          <a class="nav-link" href="/voyager">Administrador</a>
        </li>
      </ul>
    </nav>
    <div class="container">
      <div class="card my-5">
        <div class="card-body">
          @yield('content')
        </div>
      </div>
    </div>
  </body>

</html>
