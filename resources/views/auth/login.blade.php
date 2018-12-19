@extends('layouts.app')

@section('content')
<div class="container">
    <div class="flex">
        <div class="w-1/2 m-8">
            <h1 class="text-grey-darkest text-2xl pb-6">Déjà inscrit ?</h1>
            <form method="post" action="{{ route('login') }}">
                <div class="pb-4">
                    <input type="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" placeholder="Votre adresse email" required>
                </div>

                <div class="pb-2">
                    <input type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" placeholder="Votre mot de passe" required>
                </div>

                <div class="pb-4">
                    <a href="" class="mb-4 text-xs">Mot de passe oublié ?</a>
                </div>
                
                <button type="submit" class="w-full bg-blue hover:bg-blue-dark text-white font-bold py-3 px-4 rounded">
                    Valider
                </button>
            </form>
        </div>
        <div class="my-8 border-r border-grey-light"></div>
        <div class="w-1/2 m-8">
            <h1 class="text-grey-darkest text-2xl pb-6">Pas encore inscrit ?</h1>
            <form method="post" action="{{ route('register') }}">
                <div class="pb-4">
                    <input type="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" placeholder="Votre adresse email" required>
                </div>

                <div class="pb-4">
                    <input type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" placeholder="Votre mot de passe" required>
                </div>

                <div class="pb-4">
                    <input type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" placeholder="Valider votre mot de passe" required>
                </div>
                
                <button type="submit" class="w-full bg-blue hover:bg-blue-dark text-white font-bold py-3 px-4 rounded">
                    Valider
                </button>
            </form>
        </div>
    </div>

</div>
@endsection
