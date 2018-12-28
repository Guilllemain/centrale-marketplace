@extends('layouts.app')

@section('content')
<div class="container">
    {{-- {{ dd($basket->getCompanies()) }} --}}
  {{--   this.basket.companyGroups.forEach(company => 
                    company.shippingGroups.forEach(group => 
                        group.items.forEach(item => 
                            this.items.push(item)))) --}}
    @foreach ($basket->getCompanies() as $company)
        <div class="my-4">
            <h4>{{ $company['company']['name'] }}</h4>
            @foreach($company['shippingGroups'] as $shippingGroup)
                <input type="hidden" name="shippingGroups[]" value="{{$shippingGroup['id']}}">
                @foreach($shippingGroup['items'] as $item)
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <a class="mr-2" href="#" onclick="event.preventDefault();
                                                         document.getElementById('basket-delete-{{$item['declinationId']}}').submit();">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24">
                                    <use href="{{asset('svg/icons.svg#delete')}}"></use>
                                </svg>
                            </a>
                            <form id="basket-delete-{{$item['declinationId']}}" class="hidden" action="{{ route('basket.delete', [$basket->id, $item['declinationId']]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                            </form>
                            <h3>{{ $item['productName']}}</h3>
                        </div>
                        <div class="flex">Quantité :
                            <form id="update-qty-{{$item['declinationId']}}" action="{{ route('basket.update-qty', $basket->id) }}" method="POST">
                                @csrf
                                    <input type="hidden" name="declinationId" value="{{$item['declinationId']}}">
                                    <select name="item_qty" onchange="event.preventDefault();
                                                                 document.getElementById(`update-qty-{{$item['declinationId']}}`).submit();">
                                        @for($i = 1; $i < 20; $i++)
                                            @if($i === $item['quantity'])
                                                <option value="{{$i}}" selected>{{$i}}</option>
                                            @else
                                                <option value="{{$i}}">{{$i}}</option>
                                            @endif
                                        @endfor
                                    </select>
                            </form>
                        </div>
                        <div>Total : {{$item['total']}}€</div>
                    </div>
                @endforeach
            @endforeach
        </div>
    @endforeach
</div>
@endsection
