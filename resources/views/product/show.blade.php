@extends('layouts.app')

@section('content')
    <div class="container mt-16">
        <div class="flex">
            <product-images-component name="{{ $product->name }}" :images="{{ $product->getImages() }}"></product-images-component>
            
            <div class="ml-12">
                <div class="flex">
                    <h3 class="text-lg tracking-wide mr-6">{{ $product->name }}</h3>
                    <favorite-component @if(session('authenticated')) :auth="{{ true }}" @endif :product="{{ $product }}"></favorite-component>
                </div>
                <stars-component></stars-component>
                <div class="my-2 border-b border-grey-light w-full"></div>
                <div class="mb-6">
                    @if($product->declinations[0]['crossedOutPrice'])
                    <div class="flex items-baseline">
                        <div class="text-red-dark text-xl mr-4">{{ formatPrice($product->minPrice) }} €</div>
                        <div class="line-through text-sm">{{ formatPrice($product->declinations[0]['crossedOutPrice']) }} €</div>
                    </div>
                    <div>{{calcDiscount($product->declinations[0]['originalPrice'], $product->declinations[0]['crossedOutPrice'])}} € d'économies</div>
                    @else
                        <div class="text-xl">{{ formatPrice($product->minPrice) }} €</div>
                    @endif
                </div>
                <div class="mb-3 text-base tracking-tight font-light">{!! $product->shortDescription !!}</div>
                <p>Code EAN : {{ $product->code }}</p>
                <div class="flex items-center">
                    <span>Quantité :</span>
                    <form class="ml-2 flex items-center" action="{{ route('basket.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="declinationId" value="{{$product->declinations[0]['id']}}">
                        <div class="relative mr-8">
                            <select class="block w-full appearance-none bg-white border border-grey-light hover:border-grey px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none" name="quantity">
                                @if ($product->declinations[0]['amount'] > 19)
                                    @for($i = 1; $i < 20; $i++)
                                        <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                                @else
                                    @for($i = 1; $i <= $product->declinations[0]['amount']; $i++)
                                        <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                                @endif
                            </select>
                            <div class="pointer-events-none absolute pin-y pin-r flex items-center px-2 text-grey-darker">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                </svg>
                            </div>
                        </div>
                        <button type="submit" class="translateY my-4 text-center bg-orange-dark hover:bg-orange hover:text-white text-white font-bold py-3 px-4 rounded focus:outline-none">Ajouter au panier</button>
                    </form>
                    {{-- <div class="mr-4 flex appearance-none border border-grey-light rounded text-grey-darker leading-tight focus:outline-none focus:bg-white focus:border-grey-darker">
                        <button class="hover:bg-grey-light border-r border-grey-light px-2 focus:outline-none" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path d="M19 13H5v-2h14v2z"/>
                                <path d="M0 0h24v24H0z" fill="none"/>
                            </svg>
                        </button>
                        <input class="text-center w-16 appearance-none py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:bg-white focus:border-grey-darker" type="number" min="1">
                        <button class="hover:bg-grey-light px-2 border-l border-grey-light focus:outline-none" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
                                <path d="M0 0h24v24H0z" fill="none"/>
                            </svg>
                        </button>
                    </div> --}}
                </div>

                <div class="mr-6">Vendu par 
                    @if(count($product->companies) === 1)
                        <a class="font-semibold hover:font-bold" href="/company/{{ $product->companies[0]['slug'] }}">
                            {{ $product->companies[0]['name'] }}
                        </a>
                    @else
                        <a href="">
                            {{ count($product->companies) }} vendeurs
                        </a>
                    @endif
                </div>
                <div class="text-xs text-green-dark italic">{{ inStock($product->declinations[0]['isAvailable']) }}</div>
                @if($product->declinations[0]['amount'] <= 3)
                    <div class="text-xs text-red-dark">Plus que {{$product->declinations[0]['amount']}} article(s) disponible</div>
                @endif
            </div>
        </div>


    </div>

    @include('partials.product.description')
    <div class="container">
        
        <div class="glide">
          <div class="glide__track" data-glide-el="track">
            <ul class="glide__slides">
                @foreach($product->images as $image)
                    <li class="glide__slide">
                        <img src="https://back.vegan-place.com/api/v1/image/{{ $image['id'] }}?w=200&h=200">
                    </li>
                @endforeach
            </ul>
          </div>
          <div class="glide__arrows" data-glide-el="controls">
              <button class="glide__arrow glide__arrow--left" data-glide-dir="<">prev</button>
              <button class="glide__arrow glide__arrow--right" data-glide-dir=">" id="api-go-forward">next</button>
            </div>
            <div class="glide__bullets" data-glide-el="controls[nav]">
                <button class="glide__bullet" data-glide-dir="=0"></button>
                <button class="glide__bullet" data-glide-dir="=1"></button>
                <button class="glide__bullet" data-glide-dir="=2"></button>
              </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        const glide = new window.Glide('.glide', {
          type: 'carousel',
          perView: 5
        });
        var forward = document.querySelector('#api-go-forward');
        forward.addEventListener('click', function () {
          glide.go('>')
        })
        glide.mount();
    </script>
@endsection
