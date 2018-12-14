@extends('layouts.app')

@section('content')
    <div class="container mt-16">
        <div class="flex">
            <div class="flex flex-col">
                @foreach ($product->images as $image)
                    <img class="mr-12" src="https://back.vegan-place.com/api/v1/image/{{ $image['id'] }}?w=420&h=420">
                @endforeach
            </div>
            <div>
                <h3 class="text-lg tracking-wide">{{ $product->name }}</h3>
                <p class="text-lg mb-6">{{ $product->minPrice }}€</p>
                <div class="mb-3 text-base tracking-tight font-light">{!! $product->shortDescription !!}</div>
                <p>Code EAN : {{ $product->code }}</p>
                <div class="mr-6">Vendu par 
                    <a href="/company/{{ $product->companies[0]['slug'] }}">
                        {{ $product->companies[0]['name'] }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection