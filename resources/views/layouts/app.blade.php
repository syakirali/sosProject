<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <div style="margin-top:-10px;">
                            <img src="/gambar/Unair_compressed.png" alt="Brand" height="40px" width="40px">
                            {{ config('app.name', 'Laravel') }}
                        </div>
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                        @else
                            @if(Auth::user()->position_id == 1)
                            <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Agenda<span class="caret"></span>
                              </a>
                              <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ route('agenda tampil') }}">List Agenda</a></li>
                                <li><a href="{{ route('agenda form') }}">Tambah Agenda</a></li>
                              </ul>
                            </li>

                            <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Petugas<span class="caret"></span>
                              </a>
                              <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ route('petugas tampil') }}">List Petugas</a></li>
                                <li><a href="{{ route('petugas tambah') }}">Tambah Petugas</a></li>
                              </ul>
                            </li>

                            <li class="dropdown">
                              <a href="{{ route('laporan tampil') }}" class="dropdown-toggle" role="button">
                                Laporan</span>
                              </a>
                            </li>
                            @else
                            <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Agenda<span class="caret"></span>
                              </a>
                              <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ route('agenda tampil') }}">Agendaku</a></li>
                                <li><a href="{{ route('laporan form') }}">Tambah Laporan</a></li>
                              </ul>
                            </li>
                        @endif
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                          </a>

                          <ul class="dropdown-menu" role="menu">
                            <li>
                              <a href="{{ route('beranda') }}">Beranda</a>
                            </li>
                            <li>
                              <a href="{{ route('logout') }}"
                              onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                              Logout
                              </a>

                              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                              </form>
                            </li>
                          </ul>
                        </li>
                        @endif
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/jqery-1.12.4.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
