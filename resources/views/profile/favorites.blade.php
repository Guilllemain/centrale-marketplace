@extends('layouts.app')

@push('head')
    <title>{{ config('app.name', 'Laravel') }} - Mon compte</title>
@endpush

@section('content')
    <div class="container mt-16">
        <div class="flex">

            @include('partials._profile_nav')

            <div class="w-2/3">
                <h3 class="mb-4 font-light uppercase">Produits favoris</h3>
                <div class="h-bar w-1/3 mb-6"></div>
                @if(!$favorites)
                    <div>
                        Vous n'avez aucun produit dans vos favoris
                    </div>
                    <div class="mt-4">
                        <a href="/search" class="text-center bg-orange-dark hover:bg-orange hover:text-white text-white font-bold py-2 px-4 rounded">Parcourir les produits</a>
                    </div>
                @else
                    <div class="flex flex-wrap">
                        @foreach($favorites as $favorite)
                            <div class="w-1/4 m-3 flex flex-col items-center justify-center bg-white pb-4 rounded shadow">
                                <a href="{{ getProductPath($favorite) }}" class="flex flex-col items-center justify-center px-2 my-2">
                                    <img src="{{ config('marketplace.http_client.base_uri') . "image/" . $favorite['mainImage']['id'] . "?w=200&h=200"}}">
                                    <div class="my-2 border-b border-grey-light w-full"></div>
                                    <h3>{{ $favorite['name'] }}</h3>
                                </a>
                                <div>{{ $favorite['prices']['priceWithTaxes'] }} €</div>

                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
