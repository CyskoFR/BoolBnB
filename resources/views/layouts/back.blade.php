<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'BoolBnB Backoffice') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>

    <header>
        <div class="header_component container-fluid d-flex justify-content-between align-items-center">
            <a class="logo_link" href="/">
                <img class="logo_img" src="{{asset('images/logo_boolbnb.png')}}" alt="logo">
            </a>
            <nav class="main-nav">
                <div id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
        
                    <!-- Right Side Of Navbar -->
                    <div class="navbar-nav">
                        <!-- Authentication Links -->
                        @guest
                        <div class="nav_box d-flex">
                            <div class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </div>
                            @if (Route::has('register'))
                            <div class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </div>
                            @endif    
                        </div>
                        @else

                        <div class="header_user d-flex align-items-center justify-content-center">
                            <div class="dropdown">
                                <button class="user_dropdown btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item " href="{{ route('logout') }}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>    
                                </div>
                            </div>
                            <div class="header_user_icon d-flex align-items-center fa-regular fa-user justify-content-center"></div>
                        </div>
                        @endguest
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

</body>

</html>