@extends('layouts.app')

@section('content')
<div class="container mt-16">
    <h2 class="text-center mb-8">Mon profil</h2>
    <div class="flex justify-around">
        <div class="flex flex-col bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <a class="uppercase mb-4 hover:font-bold font-light" href="">Mes informations personnelles</a>
            <a class="uppercase mb-4 hover:font-bold font-light" href="">Mes commandes</a>
            <a class="uppercase mb-4 hover:font-bold font-light" href="">Mes adresses</a>
            <a class="uppercase mb-4 hover:font-bold font-light" href="">Newsletter</a>
            <a class="uppercase mb-4 hover:font-bold font-light" href="">Mes messages</a>
        </div>
        <div class="w-1/3">
            <form method="POST" action="{{ route('user.update', $user->id) }}">
                @csrf
                @method('PATCH')
                <h3>Coordonnées</h3>
                <label>Email</label>
                <div class="pb-4">
                    <input type="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" name="email" placeholder="Votre adresse email" value="{{ $user->email }}" required>
                </div>

                <label>Nom</label>
                <div class="pb-4">
                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" name="lastName" placeholder="Votre nom" value="@if($user->lastName) {{ $user->lastName }} @endif" required>
                </div>
                
                <label>Prénom</label>
                <div class="pb-4">
                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" name="firstName" placeholder="Votre prénom" value="@if($user->firstName) {{ $user->firstName }} @endif" required>
                </div>

                <button type="submit" name="user_details" class="w-full bg-blue hover:bg-blue-dark text-white font-bold py-3 px-4 rounded">
                    Mettre à jour
                </button>
            </form>
        </div>
        <div class="w-1/3">
            <form method="POST" action="{{ route('user.update', $user->id) }}">
                @csrf
                @method('PATCH')
                <h3>Changer de mot de passe</h3>
                <label>Nouveau mot de passe</label>
                <div class="pb-4">
                    <input type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" name="password" placeholder="Nouveau mot de passe" required>
                </div>
                
                <label>Confirmation mot de passe</label>
                <div class="pb-4">
                    <input type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" name="password_confirmation" placeholder="Confirmez le nouveau mot de passe" required>
                </div>                

                <button type="submit" name="user_passsword" class="w-full bg-blue hover:bg-blue-dark text-white font-bold py-3 px-4 rounded">
                    Modifier le mot de passe
                </button>
            </form>
        </div>
    </div>
</div>
<div class="container">
    <form method="POST" action="{{ route('user.update.address', $user->id) }}">
        @csrf
        @method('PATCH')
        <div class="flex">
            <div class="w-1/2 mr-8">
                <h3>Adresse</h3>
                
                <div>
                    <label>Titre</label>
                    <select name="billing_address[title]">
                        <option value="M.">M.</option>
                        <option value="Mme">Mme</option>
                    </select>
                </div>

                <label>Nom</label>
                <div class="pb-4">
                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" name="billing_address[lastName]" placeholder="Votre nom" value="@if($user->addresses['billing']['lastname']) {{ $user->addresses['billing']['lastname'] }} @endif">
                </div>
                
                <label>Prénom</label>
                <div class="pb-4">
                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" name="billing_address[firstName]" placeholder="Votre prénom" value="@if($user->addresses['billing']['firstname']) {{ $user->addresses['billing']['firstname'] }} @endif">
                </div>

                <label>Téléphone</label>
                <div class="pb-4">
                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" name="billing_address[phone]" placeholder="Votre téléphone" value="@if($user->addresses['billing']['phone']) {{ $user->addresses['billing']['phone'] }} @endif">
                </div>

                <label>Adresse</label>
                <div class="pb-4">
                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" name="billing_address[address]" placeholder="Votre adresse" value="@if($user->addresses['billing']['address']) {{ $user->addresses['billing']['address'] }} @endif">
                </div>

                <address-component city-input-name="billing_address[city]" zip-code-input-name="billing_address[zipcode]"></address-component>

                <button type="submit" name="addresses" class="w-full bg-blue hover:bg-blue-dark text-white font-bold py-3 px-4 rounded">
                    Mettre à jour
                </button>
            </div>
            {{-- <div class="w-1/2 ml-8">
                <h3>Adresse de livraison</h3>
                
                <div>
                    <label>Titre</label>
                    <select name="delivery_address[title]">
                        <option value="M.">M.</option>
                        <option value="Mme">Mme</option>
                    </select>
                </div>

                <label>Nom</label>
                <div class="pb-4">
                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" name="delivery_address[lastName]" placeholder="Votre nom" required>
                </div>
                
                <label>Prénom</label>
                <div class="pb-4">
                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" name="delivery_address[lastName]" placeholder="Votre prénom" required>
                </div>

                <label>Téléphone</label>
                <div class="pb-4">
                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" name="delivery_address[phone]" placeholder="Votre téléphone" required>
                </div>

                <label>Adresse</label>
                <div class="pb-4">
                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" name="delivery_address[address]" placeholder="Votre adresse" required>
                </div>
                
                <address-component city-input-name="delivery_address[city]" zip-code-input-name="delivery_address[zipcode]"></address-component>

                <button type="submit" name="user_address" class="w-full bg-blue hover:bg-blue-dark text-white font-bold py-3 px-4 rounded">
                    Mettre à jour
                </button>
            </div> --}}
        </div>
    </form>
</div>
@endsection
