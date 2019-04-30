@extends('layouts.app')

@push('head')
    <title>{{ config('app.name', 'Laravel') }} - Mon compte</title>
@endpush

@section('content')
    <div class="container mt-16">
        <div class="flex">

            @include('partials._profile_nav')

            <div class="w-2/3">
                @if (!$isSubscribed)
                    <form action="" method="POST" id="newsletter_form" class="mb-4">
                        @csrf
                        <label for="newsletter">
                            <input type="checkbox" name="newsletter" id="newsletter" onchange="document.querySelector('.newsletter_form').submit()">
                            <span>M'abonner à la newsletter</span>
                        </label>
                    </form>
                    <p>En cliquant, vous vous inscrivez à la newsletter vegan-place.com et recevrez, par email, toute notre actualité.</p>
                @else 
                    <form action="" method="POST" id="newsletter_form" class="mb-4">
                        @csrf
                        <label for="newsletter">
                            <input checked type="checkbox" name="newsletter" id="newsletter" onchange="document.querySelector('.newsletter_form').submit()">
                            <span>M'abonner à la newsletter</span>
                        </label>
                    </form>
                    <p>En cliquant, vous vous désinscrivez à la newsletter vegan-place.com et ne recevrez plus d'email de notre part.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
