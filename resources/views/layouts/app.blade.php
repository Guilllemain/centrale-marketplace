<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <header class="m-6">
            <div class="container">
                <div class="flex justify-between items-center">
                    <a class="" href="{{ url('/') }}">
                        <img src="{{ asset('logo.png') }}">
                    </a>

                    <search-box-component></search-box-component>

                    <div class="">
                        <!-- Right Side Of Navbar -->
                        <ul class="flex list-reset">
                            <!-- Authentication Links -->
                            @guest
                                <li class="mr-3">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="mr-3">
                                        <a class="" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="">
                                    <a class="" href="#" role="button" >
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    <div class="">
                                        <a class="" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                            <li>
                                <a href="">Mon panier</a>
                                <basket-component></basket-component>
                            </li>
                        </ul>
                    </div>
                </div>  
            </div>
        </header>

        @include('partials.nav')

        <main class="">
            @yield('content')
        </main>
    </div>
</body>
</html>
