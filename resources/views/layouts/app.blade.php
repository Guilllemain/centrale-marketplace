<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @routes
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('css')
</head>
<body>
    <div id="app">
        <header class="p-6">
            <div class="container">
                <div class="flex justify-between items-center relative">
                    <a class="" href="{{ url('/') }}">
                        <img src="{{ asset('logo.png') }}">
                    </a>

                    <search-box-component></search-box-component>

                    <div class="">
                        <!-- Right Side Of Navbar -->
                        <ul class="flex list-reset">
                            <!-- Authentication Links -->
                            @if(!session('authenticated'))
                                <li class="mr-3">

                                    <a class="flex flex-col items-center" href="{{ route('login') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24">
                                            <use class="text-orange-dark fill-current" href="{{asset('icons/icons.svg#login')}}"></use>
                                        </svg>
                                        <h4 class="font-normal">{{ __('Se connecter') }}</h4>
                                    </a>
                                </li>
                                {{-- @if (Route::has('register'))
                                    <li class="mr-3">
                                        <a class="" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif --}}
                            @else
                                <li class="mr-3">
                                    <div class="">
                                        <a class="flex flex-col items-center" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24">
                                                <use class="text-orange-dark fill-current" href="{{asset('icons/icons.svg#login')}}"></use>
                                            </svg>
                                            <h4 class="font-normal">{{ __('Se déconnecter') }}</h4>
                                        </a>
                                        <a class="block mt-2" href="{{ route('user.show') }}">Mon profil</a>

                                        <form id="logout-form" class="hidden" action="{{ route('logout') }}" method="POST">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                            <li class="basket">
                                <a class="flex flex-col items-center" href="/basket">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24">
                                        <use class="text-orange-dark fill-current" href="{{asset('icons/icons.svg#basket')}}"></use>
                                    </svg>
                                    <h4 class="font-normal">Mon panier</h4>
                                </a>
                                <div class="basket__content">
                                    <basket-component></basket-component>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>  
            </div>
        </header>

        @include('partials.nav')

        <main>
            @yield('content')
            @if ($errors->any())
                <div class="alert alert-danger text-center">
                    <ul class="list-reset text-red">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </main>
    </div>
    <script src="//code.tidio.co/tfbpqyj9ssgdjacgc4oguz3ftbhgmz83.js"></script>
</body>
</html>
