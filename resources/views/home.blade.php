@extends('layouts.app')

@push('head')
    <title>{{ config('app.name', 'Laravel') }} - Accueil</title>
    <meta name="description" content="">
@endpush

@section('content')
    
    <div class="my-16 mx-32">
        <h1 class="title--horizontal-bar uppercase mb-6 text-2xl tracking-wide font-light">Nouveautés</h1>
        
        <carousel-component></carousel-component>
    </div>
@endsection
