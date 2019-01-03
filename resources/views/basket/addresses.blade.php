@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="POST" action="{{ route('basket.update-address', $user->id) }}">
        @csrf
        @method('PATCH')
            <div class="flex">
                <div class="w-1/2 mr-8">
                    <h3>Adresse de facturation</h3>
                    
                    <div class="my-4">
                        <label class="mr-2" for="mister">Monsieur</label>
                        <input type="radio" id="mister" name="billing_address[title]" value="M." @if($user->addresses['billing']['title'] === 'M.') checked @endif>
                        <label class="ml-8 mr-2" for="miss">Madame</label>
                        <input type="radio" id="miss" name="billing_address[title]" value="Mme" @if($user->addresses['billing']['title'] === 'Mme') checked @endif>
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
                        Procéder au paiement
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