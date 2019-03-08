@extends('layouts.app')

@push('head')
    <title>{{ config('app.name', 'Laravel') }} - {{ $product->name }}</title>
    <meta name="description" content="{{ html_entity_decode(strip_tags($product->shortDescription)) }}">
@endpush

@section('content')
    <div class="container mt-8">
        <div class="flex mb-8">
            @for ($i = 0; $i < count($product->categoryPath); $i++)
                <a
                    href="{{ breadcrumbLinks($product->categoryPath, $i) }}"
                    class="text-xs breadcrumb__path uppercase text-grey-dark"
                    >
                    {{ $product->categoryPath[$i]['name'] }}
                </a>
            @endfor
        </div>
        <div class="flex">
            <product-images-component name="{{ $product->name }}" :images="{{ $product->getImages() }}"></product-images-component>
            
            <div class="ml-12">
                <div class="flex">
                    <h3 class="text-lg tracking-wide mr-6 uppercase font-normal">{{ $product->name }}</h3>
                    <favorite-component @if(session('authenticated')) :auth="{{ true }}" @endif :product="{{ $product }}"></favorite-component>
                </div>
                <stars-component></stars-component>
                <div class="my-2 border-b border-grey-light w-full"></div>
                <div class="mb-6">
                    @if($product->declinations[0]['crossedOutPrice'])
                    <div class="flex items-baseline">
                        <div class="text-red-dark text-xl mr-4">{{ formatPrice($product->minPrice) }}</div>
                        <div class="line-through text-sm">{{ formatPrice($product->declinations[0]['crossedOutPrice']) }}</div>
                    </div>
                    <div>{{calcDiscount($product->declinations[0]['originalPrice'], $product->declinations[0]['crossedOutPrice'])}} d'économies</div>
                    @else
                        <div class="text-xl">{{ formatPrice($product->minPrice) }}</div>
                    @endif
                </div>
                <div class="mb-3 text-base tracking-tight font-light">{!! $product->shortDescription !!}</div>
                <p>Code EAN : {{ $product->code }}</p>
                 @if ($product->declinations[0]['amount'] <= 0) 
                    <button type="submit"
                        disabled
                        class="my-4 text-center bg-grey-light text-white font-bold py-3 px-4 rounded cursor-default"
                        >Rupture de stock
                    </button>
                @else
                    <div class="flex items-center">
                        <span>Quantité :</span>
                        <form class="ml-2 flex items-center" action="{{ route('basket.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="declinationId" value="{{$product->declinations[0]['id']}}">
                            <div class="relative mr-8">
                                <select class="block w-full appearance-none bg-white border border-grey-light hover:border-grey px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none" name="quantity">
                                    @if ($product->declinations[0]['amount'] > 19)
                                        @for($i = 1; $i < 20; $i++)
                                            <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    @else
                                        @for($i = 1; $i <= $product->declinations[0]['amount']; $i++)
                                            <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    @endif
                                </select>
                                <div class="pointer-events-none absolute pin-y pin-r flex items-center px-2 text-grey-darker">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                    </svg>
                                </div>
                            </div>
                        
                            <button type="submit"
                                    class="translateY my-4 text-center bg-orange-dark hover:bg-orange text-white font-bold py-3 px-4 rounded focus:outline-none"
                                    >Ajouter au panier
                            </button>
                        </form>
                    </div>
                @endif

                <div class="mr-6">Vendu par 
                    @if(count($product->companies) === 1)
                        <a class="font-semibold hover:font-bold" href="/company/{{ $product->companies[0]['slug'] }}">
                            {{ $product->companies[0]['name'] }}
                        </a>
                    @else
                        <a href="">
                            {{ count($product->companies) }} vendeurs
                        </a>
                    @endif
                </div>
                @if($product->declinations[0]['amount'] <= 5 && $product->declinations[0]['amount'] > 0)
                    <div class="text-xs text-red-dark">Plus que {{$product->declinations[0]['amount']}} article(s) disponible</div>
                @elseif ($product->declinations[0]['amount'] === 0)
                    <div class="text-xs text-red-dark">Ce produit a été victime de son succès</div>
                @else
                    <div class="text-xs text-green-dark">En stock</div>
                @endif
            </div>
        </div>
    </div>

    @include('partials.product.description')

    <div class="container mt-20">
        <h2 class="title--horizontal-bar uppercase mb-6 text-xl tracking-wide font-light">Produits associés</h2>

        <carousel-component></carousel-component>
    </div>
@endsection
