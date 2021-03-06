<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Dever's | @yield('title')</title>
    <link rel="icon" href="{{ asset('img/bg/icon.png') }}" type="image/icon type">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://kit.fontawesome.com/416893b2fc.js" crossorigin="anonymous"></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    @yield('css')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm sticky-top ">
            <div class="container">
                <a class="navbar-brand text-custom mlogo" href="{{ url('/home') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>
                    <search></search>
                    <!-- Right Side Of Navbar -->
                    
                    <ul class="navbar-nav ml-md-5">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                               <b>{{ Auth::user()->name }} </b> <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu nr" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('profile.show',auth()->user()->slug) }}">
                                    My profile
                                </a>
                                <a class="dropdown-item" href="{{ route('profile.edit',auth()->user()->slug) }}">
                                    Edit profile
                                </a>
                                @handheld
                                <a class="dropdown-item" href="{{ route('profile.edit',auth()->user()->slug) }}">
                                    Friends
                                </a>
                                <a class="dropdown-item" href="{{ route('profile.edit',auth()->user()->slug) }}">
                                    Friend Request
                                </a>
                                <a class="dropdown-item" href="{{ route('search') }}">
                                    Search
                                </a>
                                @endhandheld
                                <hr>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                                
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-3">
            @yield('content')

        {{-- <noty :myid="{{auth()->user()->id}}">
            </noty>
        </main> --}}
    </div>

    <script
    src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>    
    @yield('js')
    {{-- @if(Session::has('success'))
    <script>
            noty({
            theme: 'sunset',
            type: 'success',
            layout: 'topRight',
            text: '{{ Session::get('success') }}'
        }).show();
        
    </script>
    @endif --}}
</body>
</html>
