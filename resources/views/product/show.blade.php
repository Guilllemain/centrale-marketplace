@extends('layouts.app')

@section('css')
@endsection

@section('content')
    <div class="container mt-16">
        <div class="flex">
            <div class="flex flex-col">
                <img class="mr-12" src="https://back.vegan-place.com/api/v1/image/{{ $product->images[0]['id'] }}?w=420&h=420">
                <div class="flex flex-start mt-2">
                    @foreach ($product->images as $image)
                        <div class="mr-1 border border-grey-light">
                            <img class="w-full" src="https://back.vegan-place.com/api/v1/image/{{ $image['id'] }}?w=100&h=100">
                        </div>
                    @endforeach
                </div>
            </div>
            <div>
                <h3 class="text-lg tracking-wide">{{ $product->name }}</h3>
                <stars-component></stars-component>
                <div class="my-2 border-b border-grey-light w-full"></div>
                <p class="text-lg mb-6">{{ $product->minPrice }}€</p>
                <div class="mb-3 text-base tracking-tight font-light">{!! $product->shortDescription !!}</div>
                <p>Code EAN : {{ $product->code }}</p>
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
