@extends('layouts.app')

@section('content')

    <div class="container">
        @isset($currentCategory)
            <div class="py-6">
                <h1 class="text-center">{{ $currentCategory->name }}</h1>
            </div>
        @endisset

        @isset($currentCompany)
            <div class="my-4">
                <h1 class="text-center">{{ $currentCompany->name }}</h1>
                <div class="my-6">{!! $currentCompany->description !!}</div>
            </div>
        @endisset
    </div>
	<search-component
        @isset($currentCompany) :company="{{$currentCompany}}" @endisset
        @isset($currentCategory) :category="{{$currentCategory}}" @endisset
    >
    </search-component>
@endsection