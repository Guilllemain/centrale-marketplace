@extends('layouts.app')

@section('content')
    <div class="container mt-16">
        <div class="flex">

            @include('partials._profile_nav')

            <div class="w-2/3">
                @foreach($orders as $order)
                    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 w-full">
                        <div class="flex">
                            <div class="uppercase text-xs mr-12">Commande effectuée le
                                <span class="block lowercase">{{\Carbon\Carbon::createFromTimestamp($order['timestamp'])->formatLocalized('%d %B %Y')}}</span>
                            </div>
                            <div class="uppercase text-xs">Total <span class="block">{{ $order['total'] }}€</span></div>
                            <div class="uppercase text-xs ml-auto">N° de commande <span>{{ $order['id'] }}</span></div>
                        </div>
                        <div class="h-bar mb-2"></div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
