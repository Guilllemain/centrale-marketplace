@extends('layouts.app')

@section('content')
    <div class="container mt-16">
        <div class="flex">
            <div class="w-1/2">
                <product-images-component name="{{ $product->name }}" :images="{{ $product->getImages() }}"></product-images-component>
            </div>
            
            <div class="ml-12">
                <div class="flex">
                    <h3 class="text-lg tracking-wide mr-16">{{ $product->name }}</h3>
                    <favorite-component @if(session('authenticated')) :auth="{{ true }}" @endif :product="{{ $product }}"></favorite-component>
                </div>
                <stars-component></stars-component>
                <div class="my-2 border-b border-grey-light w-full"></div>
                <p class="text-lg mb-6">{{ formatPrice($product->minPrice) }} €</p>
                <div class="mb-3 text-base tracking-tight font-light">{!! $product->shortDescription !!}</div>
                <p>Code EAN : {{ $product->code }}</p>
                <div class="flex items-center">
                    <span>Quantité :</span>
                    <form class="ml-2 flex items-center" action="{{ route('basket.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="declinationId" value="{{$product->declinations[0]['id']}}">
                        <div class="relative mr-8">
                            <select class="block w-full appearance-none bg-white border border-grey-light hover:border-grey px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline" name="quantity">
                                @for($i = 1; $i < 20; $i++)
                                    <option value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
                            <div class="pointer-events-none absolute pin-y pin-r flex items-center px-2 text-grey-darker">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                </svg>
                            </div>
                        </div>
                        <button type="submit" class="my-4 text-center bg-orange-dark hover:bg-orange hover:text-white text-white font-bold py-3 px-4 rounded">Ajouter au panier</button>
                    </form>
                    {{-- <div class="mr-4 flex appearance-none border border-grey-light rounded text-grey-darker leading-tight focus:outline-none focus:bg-white focus:border-grey-darker">
                        <button class="hover:bg-grey-light border-r border-grey-light px-2 focus:outline-none" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path d="M19 13H5v-2h14v2z"/>
                                <path d="M0 0h24v24H0z" fill="none"/>
                            </svg>
                        </button>
                        <input class="text-center w-16 appearance-none py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:bg-white focus:border-grey-darker" type="number" min="1">
                        <button class="hover:bg-grey-light px-2 border-l border-grey-light focus:outline-none" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
                                <path d="M0 0h24v24H0z" fill="none"/>
                            </svg>
                        </button>
                    </div> --}}
                </div>
                <div class="mr-6">Vendu par 
                    @if(count($product->companies) === 1)
                        <a href="/company/{{ $product->companies[0]['slug'] }}">
                            {{ $product->companies[0]['name'] }}
                        </a>
                    @else
                        <a href="">
                            {{ count($product->companies) }} vendeurs
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
