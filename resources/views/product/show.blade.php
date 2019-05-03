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
                <div class="mb-6 text-base tracking-tight font-light">{!! $product->shortDescription !!}</div>
                <p>Code EAN : {{ $product->code }}</p>
                @if ($product->declinations[0]['amount'] <= 0) 
                    <button type="submit"
                        disabled
                        class="my-4 text-center bg-grey-light text-white font-bold py-3 px-4 rounded cursor-default"
                        >Rupture de stock
                    </button>
                @else
                    <div class="my-4 flex items-center">
                        <span>Quantité :</span>
                        <add-to-cart-component name="{{$product->name}}" :product="{{json_encode($product->declinations[0])}}"></add-to-cart-component>
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
