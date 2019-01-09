@extends('layouts.app')

@section('content')
    <div class="container mt-16">
        <div class="flex">

            @include('partials._profile_nav')

            <div class="w-2/3">
                @foreach($orders as $order)
                    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 w-full">
                        <div class="flex">
                            <div class="uppercase text-xs mr-12">Commande effectuée le
                                <span class="block lowercase">
                                    {{\Carbon\Carbon::createFromTimestamp($order['timestamp'])->formatLocalized('%d %B %Y')}}
                                </span>
                            </div>
                            <div class="uppercase text-xs">Total <span class="block">{{ $order['total'] }}€</span></div>
                            <div class="uppercase text-xs ml-auto">N° de commande <span class="font-bold">{{ $order['id'] }}</span></div>
                        </div>
                        <div class="h-bar mb-2"></div>
                        <div>Status :
                            <span>{{ __('orders.status.' . $order['status']) }}</span>
                        </div>
                        @foreach($order['items'] as $item)
                            <div class="flex mt-4">
                                <div class="w-1/5 mr-8">
                                    <img class="w-full" src="https://sandbox.wizaplace.com/api/v1/image/{{ $item['productImageId']}}">
                                </div>
                                <div>
                                    <h4>{{ $item['productName'] }}</h4>
                                    <div>Quantité : <span>{{ $item['amount'] }}</span></div>
                                    <div>{{ $item['price'] }} €</div>
                                </div>
                                <div class="ml-auto">
                                    <button class="block w-full text-center bg-orange-dark hover:bg-orange hover:text-white text-white py-2 px-4 rounded">Suivre mon colis</button>
                                    <button class="text-center mt-4 bg-orange-dark hover:bg-orange hover:text-white text-white py-2 px-4 rounded">Évaluer le vendeur</button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
