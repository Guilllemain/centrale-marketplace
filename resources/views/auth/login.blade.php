@extends('layouts.app')

@section('content')
<div class="container">
    <div class="flex mt-8">
        <div class="w-1/2 mx-16 my-8">
            <h1 class="text-grey-darkest text-2xl mb-2">Déjà inscrit ?</h1>
            <div class="border-b border-grey-light w-1/3 mb-6"></div>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="pb-4">
                    <input type="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" name="email" placeholder="Votre adresse email" required>
                </div>

                <div class="pb-2">
                    <input type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" name="password" placeholder="Votre mot de passe" required>
                </div>

                <div class="mt-4 flex justify-between items-center">
                    <button type="submit" class="translateY bg-orange-dark hover:bg-orange text-white font-bold py-3 px-4 rounded">
                        Se connecter
                    </button>
                    <a href="{{ route('password_reset') }}" class="hover:text-orange text-orange-dark">Mot de passe oublié ?</a>
                </div>
            </form>
        </div>
        <div class="my-8 border-r border-grey-light"></div>
        <div class="w-1/2 mx-16 my-8">
            <h1 class="text-grey-darkest text-2xl mb-2">Pas encore inscrit ?</h1>
            <div class="border-b border-grey-light w-1/3 mb-6"></div>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="pb-4">
                    <input type="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" name="email" placeholder="Votre adresse email" required>
                </div>

                <div class="pb-4">
                    <input type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" name="password" placeholder="Votre mot de passe" required>
                </div>

                <div class="pb-4">
                    <input type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" name="password_confirmation" placeholder="Valider votre mot de passe" required>
                </div>
                
                <button type="submit" class="translateY w-full bg-orange-dark hover:bg-orange text-white font-bold py-3 px-4 rounded">
                    Valider
                </button>
            </form>
        </div>
    </div>

</div>
@endsection
