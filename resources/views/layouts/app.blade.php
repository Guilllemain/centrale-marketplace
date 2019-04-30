<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @stack('head')

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
    <div id="app" class="flex-col flex h-full relative">
        <div>
            <header class="p-6">
                <div class="container">
                    <div class="flex justify-between items-center relative">
                        <a href="{{ url('/') }}">
                            <img srcset="{{ asset('logo-1x.png') }}, {{ asset('logo-2x.png') }} 2x">
                        </a>

                        <search-box-component></search-box-component>

                        <div class="">
                            <!-- Right Side Of Navbar -->
                            <div class="flex items-end">
                                <!-- Authentication Links -->
                                @if(!session('authenticated'))
                                    <sign-up-component>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8">
                                            <use class="text-orange-dark fill-current" href="/svg/icons.svg#login"></use>
                                        </svg>
                                        <h4 class="opacity-75 font-normal">Se connecter</h4>
                                    </sign-up-component>
                                @else
                                    <div class="profile">
                                        <a class="block flex flex-col items-center" href="{{ route('profile.show') }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8">
                                                <use class="text-orange-dark fill-current" href="{{asset('svg/icons.svg#login')}}"></use>
                                            </svg>
                                            <h4 class="opacity-75 font-normal">Mon compte</h4>
                                        </a>
                                        <div class="profile__links">
                                            <a class="block mt-2 flex flex-col items-center" href="{{ route('profile.show') }}">Mon profil</a>
                                            <div class="h-bar"></div>
                                            <a class="block mt-2 flex flex-col items-center" href="{{ route('profile.orders') }}">Mes commandes</a>
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

        <flash-component message="{{ session('flash') }}"></flash-component>

        @include('partials.footer')

        <compare-modal-component></compare-modal-component>
        
    </div>
    {{-- live-chat tidio --}}
    {{-- <script src="//code.tidio.co/tfbpqyj9ssgdjacgc4oguz3ftbhgmz83.js"></script> --}}
    @include('cookieConsent::index')
    @yield('scripts')
    @stack('scripts')
</body>
</html>
