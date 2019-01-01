@extends('layouts.app')

@section('content')
<div class="container flex justify-around">
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
<div class="container">
    <form name="billing_address" method="POST" action="{{ route('user.update.address', $user) }}">
        @csrf
        @method('PATCH')
        <div class="flex">
            <div class="w-1/2 mr-8">
                <h3>Adresse de facturation</h3>
                
                <div>
                    <label>Titre</label>
                    <select name="billing_address[title]">
                        <option value="M.">M.</option>
                        <option value="Mme">Mme</option>
                    </select>
                </div>

                <label>Nom</label>
                <div class="pb-4">
                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" name="billing_address[lastName]" placeholder="Votre nom">
                </div>
                
                <label>Prénom</label>
                <div class="pb-4">
                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" name="billing_address[firstName]" placeholder="Votre prénom">
                </div>

                <label>Téléphone</label>
                <div class="pb-4">
                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" name="billing_address[phone]" placeholder="Votre téléphone">
                </div>

                <label>Adresse</label>
                <div class="pb-4">
                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" name="billing_address[address]" placeholder="Votre adresse">
                </div>

                <address-component city-input-name="billing_address[city]" zip-code-input-name="billing_address[zipcode]"></address-component>

                <button type="submit" name="user_address" class="w-full bg-blue hover:bg-blue-dark text-white font-bold py-3 px-4 rounded">
                    Mettre à jour
                </button>
            </div>
            <div class="w-1/2 ml-8">
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
            </div>
        </div>
    </form>
</div>
@endsection
