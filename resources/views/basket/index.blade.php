@extends('layouts.app')

@section('content')
<div class="container flex">
    {{-- {{ dd($basket) }} --}}
    <div class="w-4/5">
        <h2>Mon panier</h2>
        @foreach ($basket->getCompanies() as $company)
            <div class="my-4 p-4 bg-white border border-grey-light">
                <h4>Vendu par {{ $company['company']['name'] }}</h4>
                <div class="my-2 border-b border-grey-light"></div>
                @foreach($company['shippingGroups'] as $shippingGroup)
                    <div class="my-4">
                        @foreach($shippingGroup['items'] as $item)
                            <div class="flex items-center">
                                <div class="flex items-center flex-1">
                                    <a class="mr-2" href="#" onclick="event.preventDefault();
                                                                 document.getElementById('basket-delete-{{$item['declinationId']}}').submit();">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24">
                                            <use href="{{asset('svg/icons.svg#delete')}}"></use>
                                        </svg>
                                    </a>
                                    <form id="basket-delete-{{$item['declinationId']}}" class="hidden" action="{{ route('basket.delete', [$basket->id, $item['declinationId']]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <h3>{{ $item['productName']}}</h3>
                                </div>
                                <div class="flex w-1/5">Quantité :
                                    <form id="update-qty-{{$item['declinationId']}}" action="{{ route('basket.update-qty', $basket->id) }}" method="POST">
                                        @csrf
                                            <input type="hidden" name="declinationId" value="{{$item['declinationId']}}">
                                            <select name="item_qty" onchange="event.preventDefault();
                                                                         document.getElementById(`update-qty-{{$item['declinationId']}}`).submit();">
                                                @for($i = 1; $i < 20; $i++)
                                                    @if($i === $item['quantity'])
                                                        <option value="{{$i}}" selected>{{$i}}</option>
                                                    @else
                                                        <option value="{{$i}}">{{$i}}</option>
                                                    @endif
                                                @endfor
                                            </select>
                                    </form>
                                </div>
                                <div class="w-1/5 text-right">
                                    <p>Total : {{$item['total']}}€</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <form id="shipping-{{ $shippingGroup['id'] }}" action="{{ route('basket.update-shipping', $basket->id) }}" method="POST">
                        @csrf
                        <label class="mr-2">Veuillez sélectionner le mode de livraison pour ce(s) produit(s)</label>
                        <input type="hidden" name="shippingGroup" value="{{$shippingGroup['id']}}">
                        <select class="appearance-none bg-white border border-grey-light hover:border-grey px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline" name="shipping_method_id"
                                onchange="event.preventDefault(); document.getElementById(`shipping-{{ $shippingGroup['id'] }}`).submit();">
                            <option>Merci de choisir votre mode d'envoi...</option>
                            @foreach($shippingGroup['shippings'] as $shippingMethod)
                                <option @if($shippingMethod['selected'] === true) selected @endif value="{{ $shippingMethod['id'] }}">{{ $shippingMethod['name'] }}</option>
                            @endforeach
                        </select>
                    </form>
                @endforeach
            </div>
        @endforeach
    </div>
    <div class="w-1/5">
        <div class="ml-8">
            <h2>Total</h2>
            <div class="my-4 p-4 bg-white border border-grey-light">
                <div class="flex justify-between -items-center">
                    <div>Livraison</div>
                    <div>{{ $basket->totalShipping }}€</div>
                </div>
                <div class="my-4 font-bold flex justify-between -items-center">
                    <div>Sous-total</div>
                    <div>{{ $basket->subtotal }}€</div>
                </div>
                <div class="my-2 border-b border-grey-light"></div>
                <div class="mt-4 font-bold flex justify-between -items-center">
                    <div>Total</div>
                    <div>{{ $basket->total }}€</div>
                </div>
                <a href="/basket/address" class="block text-center mt-4 bg-blue w-full hover:bg-blue-dark text-white font-bold py-2 px-4 rounded">Continuer</a>
            </div>
        </div>
    </div>
</div>
@endsection
