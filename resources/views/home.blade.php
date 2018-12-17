@extends('layouts.app')

@section('content')
<div>
    <img class="w-full" src="{{ asset('main.jpg') }}">
    
    <div class="my-16 mx-32">
        <h1 class="title--horizontal-bar uppercase">Nouveautés</h1>

        <div class="flex mt-6 items-end">
            @foreach($latestProducts as $product)
            {{-- {{dd($product->mainImage)}} --}}
                <div class="flex flex-col w-1/6 items-center mx-8">
                    <img class="" src="https://back.vegan-place.com/api/v1/image/{{ $product->mainImage }}?w=230&h=230">
                    <div class="my-2 border-b border-grey-light w-5/6"></div>
                    <a href="{{ route('product.show', [
                        'category' => $product->categoryPath[0]['slug'],
                        'subCategory' => $product->categoryPath[1]['slug'],
                        'finalCategory' => $product->categoryPath[2]['slug'],
                        'slug' => $product->slug,
                    ]) }}">
                        <h3 class="mb-2">{{ $product->name }}</h3>
                    </a>
                    <div class="text-base">{{ $product->minimumPrice }}€</div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
