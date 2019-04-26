@extends('layouts.app')

@push('head')
    <title>{{ config('app.name', 'Laravel') }} - Accueil</title>
    <meta name="description" content="">
@endpush

@section('content')
    <div class="home__image flex items-center justify-center">
        <div class="inline-block p-6 rounded">
            <h1 class="uppercase font-light tracking-wide mb-4">Soldes</h1>
            <h3 class="mb-4">Profitez d'une sélection de produits jusqu'à -50%</h3>
            <button class="btn btn-grey">J'en profite</button>
        </div>
    </div>
    <div class="my-16 mx-32">
        <h1 class="title--horizontal-bar uppercase mb-6 text-2xl tracking-wide font-light">Nouveautés</h1>
        
        <carousel-component></carousel-component>
    </div>
@endsection
