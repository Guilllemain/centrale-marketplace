@extends('layouts.app')

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
                        <h3 class="mb-2">Coordonnées</h3>
                        <label>Email</label>
                        <div class="pb-4">
                            <input type="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" name="email" placeholder="Votre adresse email" value="{{ $user->email }}" required>
                        </div>

                        <label>Nom</label>
                        <div class="pb-4">
                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" name="lastName" placeholder="Votre nom" value="@if($user->lastName){{$user->lastName}}@endif" required>
                        </div>
                        
                        <label>Prénom</label>
                        <div class="pb-4">
                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" name="firstName" placeholder="Votre prénom" value="@if($user->firstName){{$user->firstName}}@endif" required>
                        </div>

                        <button type="submit" name="user_details" class="w-full bg-orange-dark hover:bg-orange text-white font-bold py-3 px-4 rounded">
                            Mettre à jour
                        </button>
                    </form>
                </div>
                <div class="my-8 border-r border-grey-light mx-12"></div>
                <div class="w-1/3">
                    <form method="POST" action="{{ route('user.update', $user->id) }}">
                        @csrf
                        @method('PATCH')
                        <h3 class="mb-2">Changer de mot de passe</h3>
                        <label>Nouveau mot de passe</label>
                        <div class="pb-4">
                            <input type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" name="password" placeholder="Nouveau mot de passe" required>
                        </div>
                        
                        <label>Confirmation mot de passe</label>
                        <div class="pb-4">
                            <input type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" name="password_confirmation" placeholder="Confirmez le nouveau mot de passe" required>
                        </div>                

                        <button type="submit" name="user_passsword" class="w-full bg-orange-dark hover:bg-orange text-white font-bold py-3 px-4 rounded">
                            Modifier le mot de passe
                        </button>
                    </form>
                </div>
            </div>
            </div>
    </div>
@endsection
