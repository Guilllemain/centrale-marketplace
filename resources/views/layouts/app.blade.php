<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="https://js.stripe.com/v3/"></script>
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
    <div id="app" class="flex-col flex h-full">
        <div class="header-bg">
            <header class="p-6">
                <div class="container">
                    <div class="flex justify-between items-center relative">
                        <a href="{{ url('/') }}">
                            <img src="{{ asset('logo.png') }}">
                        </a>

                        <search-box-component></search-box-component>

                        <div class="">
                            <!-- Right Side Of Navbar -->
                            <div class="flex items-end">
                                <!-- Authentication Links -->
                                @if(!session('authenticated'))
                                    <div class="">

                                        <a class="flex flex-col items-center" href="{{ route('login') }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24">
                                                <use class="text-white fill-current" href="{{asset('icons/icons.svg#login')}}"></use>
                                            </svg>
                                            <h4 class="text-white opacity-75 font-normal">{{ __('Se connecter') }}</h4>
                                        </a>
                                    </div>
                                    {{-- @if (Route::has('register'))
                                        <li class="mr-3">
                                            <a class="" href="{{ route('register') }}">{{ __('Register') }}</a>
                                        </li>
                                    @endif --}}
                                @else
                                    <div class="profile">
                                        <a class="block flex flex-col items-center" href="{{ route('user.show') }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24">
                                                <use class="text-white fill-current" href="{{asset('icons/icons.svg#login')}}"></use>
                                            </svg>
                                            <h4 class="text-white opacity-75 font-normal">Mon compte</h4>
                                        </a>
                                        <div class="profile__content">
                                            <a class="block mt-2 flex flex-col items-center" href="{{ route('user.show') }}">Mon profil</a>
                                            <div class="h-bar"></div>
                                            <a class="block mt-2 flex flex-col items-center" href="">Mes commandes</a>
                                            <div class="h-bar"></div>
                                            <a class="flex flex-col items-center" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                                <h4 class="font-normal">{{ __('Me déconnecter') }}</h4>
                                            </a>
                                            <form id="logout-form" class="hidden" action="{{ route('logout') }}" method="POST">
                                                @csrf
                                            </form>
                                        </div>
                                    </div>
                                @endguest
                                <basket-component></basket-component>
                            </div>
                        </div>
                    </div>  
                </div>
            </header>

            @include('partials.nav')
        </div>

        <main class="flex-1">
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

        @include('footer')
    </div>
    <script src="//code.tidio.co/tfbpqyj9ssgdjacgc4oguz3ftbhgmz83.js"></script>

    @yield('scripts')

</body>
</html>
