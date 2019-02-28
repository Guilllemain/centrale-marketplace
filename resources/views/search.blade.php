@extends('layouts.app')

@push('head')
    <title>{{ config('app.name', 'Laravel') }} - Recherche</title>
    <meta name="description" content="">
@endpush

@section('content')
    
    <div class="container">
        @isset($currentCategory)
            <div class="py-6">
                <h1 class="text-center font-light uppercase text-xl">{{ $currentCategory->name }}</h1>
            </div>
        @endisset

        @isset($result)
            <div class="py-6">
                <h1 class="text-center font-light">{{ $result }}</h1>
            </div>
        @endisset
        
        @isset($currentCompany)
        {{-- {{dd($currentCompany)}} --}}
            <img src="https://back.vegan-place.com/api/v1/image/{{ $currentCompany->image['id'] }}">
            <div class="mt2- mb-8 flex flex-col items-center">
                <h1>
                    <span class="bg-black font-light px-4 rounded py-2 text-white">{{ $currentCompany->name }}</span>
                </h1>
                <div class="w-2/3 my-6">{!! $currentCompany->description !!}</div>
            </div>
        @endisset
    </div>
	<search-component
        @isset($currentCompany) :company="{{$currentCompany}}" @endisset
        @isset($currentCategory) :category="{{$currentCategory}}" @endisset
    >
    </search-component>
@endsection