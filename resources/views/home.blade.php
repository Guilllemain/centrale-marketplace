@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <style type="text/css">
        .carousel {
            height: 20rem;
        }
        .carousel-cell {
            width: 15%;
            height: 100%;
            margin-right: 2%;
            border-radius: 5px;
            transition: all .3s;
        }
        .carousel-cell:hover {
            transform: scale(1.05);
        }
    </style>
@endsection

@section('content')
    {{-- <carousel-component></carousel-component> --}}
    
    <div class="my-16 mx-32">
        <h1 class="title--horizontal-bar uppercase mb-6 text-2xl tracking-wide">Nouveautés</h1>
        
        <div class="carousel" data-flickity='{ "wrapAround": "true", "pageDots": false, "contain": true }'>
            @foreach($latestProducts as $product)
                <div class="carousel-cell">
                    <div class="flex flex-col items-center shadow-md rounded">
                        <img class="" src="https://back.vegan-place.com/api/v1/image/{{ $product->mainImage }}?w=200&h=200">
                        <div class="my-2 border-b border-grey-light w-2/3"></div>
                        {{-- <a href="{{ route('product.show', [
                            'category' => $product->categoryPath[0]['slug'],
                            'subCategory' => $product->categoryPath[1]['slug'],
                            'finalCategory' => $product->categoryPath[2]['slug'],
                            'slug' => $product->slug,
                        ]) }}"> --}}
                            <h3 class="px-3 mb-2">{{ limitStringLength($product->name) }}</h3>
                        {{-- </a> --}}
                        <div class="mb-2 text-base">{{ formatPrice($product->minimumPrice) }} €</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
@endsection
