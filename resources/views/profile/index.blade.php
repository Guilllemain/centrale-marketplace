@extends('layouts.app')

@push('head')
    <title>{{ config('app.name', 'Laravel') }} - Mon compte</title>
@endpush

@section('content')
    <div class="container mt-16">
        {{-- <h2 class="text-center mb-8">Mon profil</h2> --}}
        <div class="flex">
            
            @include('partials._profile_nav')
            
            <div class="w-2/3 flex">
                <div class="w-2/3">
                    <form method="POST" action="{{ route('user.update', $user->id) }}">
                        @csrf
                        @method('PATCH')
                        <h3 class="mb-4 font-light uppercase">Coordonnées</h3>
                        <div class="h-bar w-1/3 mb-6"></div>
                        <label>Email</label>
                        <div class="pb-4">
                            <input type="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:border-grey" name="email" placeholder="Votre adresse email" value="{{ $user->email }}" required>
                        </div>

                        <label>Nom</label>
                        <div class="pb-4">
                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:border-grey" name="lastName" placeholder="Votre nom" value="@if($user->lastName){{$user->lastName}}@endif" required>
                        </div>
                        
                        <label>Prénom</label>
                        <div class="pb-4">
                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:border-grey" name="firstName" placeholder="Votre prénom" value="@if($user->firstName){{$user->firstName}}@endif" required>
                        </div>

                        <button type="submit" name="user_details" class="btn">
                            Mettre à jour
                        </button>
                    </form>
                </div>
                <div class="my-8 border-r border-grey-light mx-12"></div>
                <div class="w-1/3">
                    <form method="POST" action="{{ route('user.update', $user->id) }}">
                        @csrf
                        @method('PATCH')
                        <h3 class="mb-4 font-light uppercase">Changer de mot de passe</h3>
                        <div class="h-bar w-1/2 mb-6"></div>

                        <label>Nouveau mot de passe</label>
                        <div class="pb-4">
                            <input type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:border-grey" name="password" placeholder="Nouveau mot de passe" required>
                        </div>
                        
                        <label>Confirmation mot de passe</label>
                        <div class="pb-4">
                            <input type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:border-grey" name="password_confirmation" placeholder="Confirmez le nouveau mot de passe" required>
                        </div>                

                        <button type="submit" name="user_passsword" class="btn">
                            Modifier le mot de passe
                        </button>
                    </form>
                </div>
            </div>
            </div>
    </div>
@endsection
