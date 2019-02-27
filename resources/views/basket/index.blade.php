@extends('layouts.app')

@section('content')
<div class="container">
    @if($basket->totalQuantity > 0)
        <div class="flex mt-8">
            <div class="w-3/4">
                <h2 class="font-light uppercase">Mon panier</h2>
                @foreach ($basket->getCompanies() as $company)
                    <div class="my-4 px-4 pt-4 pb-2 bg-white border border-grey-light">
                        <h4>Vendu par {{ $company['company']['name'] }}</h4>
                        <div class="my-2 border-b border-grey-light"></div>
                        @foreach($company['shippingGroups'] as $shippingGroup)
                            <div class="my-4">
                                @foreach($shippingGroup['items'] as $item)
                                    <div class="flex items-center mb-4">
                                        <div class="flex items-center flex-1">
                                            <img class="mr-4" src="https://back.vegan-place.com/api/v1/image/{{ $item['mainImage']['id'] }}?w=90&h=90">
                                            <div class="flex flex-col">
                                                <h3 class="ml-2">{{ $item['productName']}}</h3>
                                                <a class="mr-2 mt-2 flex items-end" href="#" onclick="event.preventDefault();
                                                                             document.getElementById('basket-delete-{{$item['declinationId']}}').submit();">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24">
                                                        <use class="text-grey fill-current" href="{{asset('svg/icons.svg#delete')}}"></use>
                                                    </svg>
                                                    <span class="text-xs text-grey">Supprimer</span>
                                                </a>
                                                <form id="basket-delete-{{$item['declinationId']}}" class="hidden" action="{{ route('basket.delete', [$basket->id, $item['declinationId']]) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </div>
                                        </div>
                                        <div class="flex items-center w-1/5">
                                            <span>Quantité :</span>
                                            <form class="ml-2" id="update-qty-{{$item['declinationId']}}" action="{{ route('basket.update-qty', $basket->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="declinationId" value="{{$item['declinationId']}}">
                                                <div class="relative">
                                                    <select class="block w-full appearance-none bg-white border border-grey-light hover:border-grey px-4 py-2 pr-8 rounded leading-tight focus:outline-none" name="item_qty" onchange="event.preventDefault();
                                                                                 document.getElementById(`update-qty-{{$item['declinationId']}}`).submit();">
                                                        @for($i = 1; $i < 20; $i++)
                                                            @if($i === $item['quantity'])
                                                                <option value="{{$i}}" selected>{{$i}}</option>
                                                            @else
                                                                <option value="{{$i}}">{{$i}}</option>
                                                            @endif
                                                        @endfor
                                                    </select>
                                                    <div class="pointer-events-none absolute pin-y pin-r flex items-center px-2 text-grey-darker">
                                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="w-1/5 text-right font-bold">
                                            <p>Total : {{formatPrice($item['total'])}} €</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="flex items-center justify-between">
                                <form id="shipping-{{ $shippingGroup['id'] }}" action="{{ route('basket.update-shipping', $basket->id) }}" method="POST" class="flex items-center">
                                    @csrf
                                    <input type="hidden" name="shippingGroup" value="{{$shippingGroup['id']}}">
                                    <label class="mr-2">Veuillez sélectionner le mode de livraison pour ce(s) produit(s)</label>
                                    <div class="relative">
                                        <select class="block w-full appearance-none bg-white border border-grey-light hover:border-grey px-4 py-2 pr-8 rounded leading-tight focus:outline-none" name="shipping_method_id"
                                                onchange="event.preventDefault(); document.getElementById(`shipping-{{ $shippingGroup['id'] }}`).submit();">
                                            <option>Merci de choisir votre mode d'envoi...</option>
                                            @foreach($shippingGroup['shippings'] as $shippingMethod)
                                                <option @if($shippingMethod['selected'] === true) selected @endif value="{{ $shippingMethod['id'] }}">{{ $shippingMethod['name'] }}</option>
                                            @endforeach
                                        </select>
                                        <div class="pointer-events-none absolute pin-y pin-r flex items-center px-2 text-grey-darker">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                            </svg>
                                        </div>
                                    </div>
                                </form>
                                <div class="font-bold">
                                    <p>Total pour ce marchand : {{ formatPrice($company['productTotalWithTaxes']) }} €</p>
                                </div>
                            </div>
                        @endforeach
                        <textarea class="appearance-none w-full bg-grey-lighter text-grey-darker border border-grey-light rounded py-3 px-4 mt-3 leading-tight focus:outline-none focus:bg-white focus:border-grey" placeholder="Ajouter un commentaire"></textarea>
                    </div>
                @endforeach
            </div>
            <div class="w-1/4">
                <div class="flex flex-col ml-8">
                    <div class="">
                        <h2 class="font-light uppercase">Total</h2>
                        <div class="my-4 p-4 bg-white border border-grey-light">
                            <div class="flex justify-between -items-center">
                                <div>Livraison</div>
                                <div>{{ formatPrice($basket->totalShipping) }} €</div>
                            </div>
                            <div class="my-4 flex justify-between -items-center">
                                <div>Sous-total</div>
                                <div>{{ formatPrice($basket->subtotal) }} €</div>
                            </div>
                            <div class="my-2 border-b border-grey-light"></div>
                            <div class="mt-4 font-bold flex justify-between -items-center">
                                <div>Total</div>
                                <div>{{ formatPrice($basket->total) }} €</div>
                            </div>
                            <a href="/basket/address" class="translateY block text-center mt-4 bg-orange-dark w-full hover:bg-orange hover:text-white text-white font-bold py-2 px-4 rounded">Continuer</a>
                        </div>
                    </div>
                    <div class="mt-8">
                        <h2 class="mb-4 font-light uppercase">Ajouter un code</h2>
                        <input class="appearance-none border rounded w-full py-3 px-3 text-grey-darker leading-tight focus:outline-none focus:border-grey" type="text" name="coupon" placeholder="Entrez votre code promo">
                    </div>
                </div>
            </div>
        </div>
    @else
        <h2 class="font-light uppercase mb-4 mt-8">Mon panier</h2>
        <div class="mb-8">Votre basket est vide</div>
        <a href="/search" class="text-center mt-4 bg-orange-dark w-full hover:bg-orange hover:text-white text-white font-bold py-2 px-4 rounded">Continuer votre shopping</a>
    @endif
    <a href="/basket/invoice">Enregistrer devis</a>
</div>
@endsection
