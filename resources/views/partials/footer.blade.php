<footer class="mt-16">
    <div class="bg-orange-lighter p-2">
        <div class="container flex items-center justify-between">
            <h4 class="w-1/4 uppercase font-normal">Inscrivez-vous à notre newsletter</h4>
            <form action="/newsletter" method="POST" class="w-1/3 flex">
                @csrf
                <input class="newsletter__input w-full p-2 outline-none tracking-wide rounded appearance-none border focus:border-orange"
                       type="text"
                       placeholder="Entrez votre adresse email"
                       name="email">
                <button class="focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 search__icon">
                        <use class="text-orange-dark fill-current" href="/svg/icons.svg#send"></use>
                    </svg>
                </button>
            </form>
            <p class="w-1/4">Ne ratez plus aucun bons plans, recevez nos meilleures promos et toutes les nouveautés...</p>
        </div>
    </div>
    <div class="bg-grey-darkest">
        <div class="py-8 text-white flex justify-center">
            @foreach ($footer_menus as $menu)
                <div class="flex flex-col p-4 w-1/6">
                    <h2 class="text-sm uppercase mb-6 font-normal">{{$menu['name']}}</h2>
                    @foreach ($menu['items'] as $item)
                        <a class="footer__item text-white font-light translateX hover:text-white hover:font-medium" href="{{$item['url']}}">{{$item['name']}}</a>
                    @endforeach
                </div>
            @endforeach
        </div>
        <div class="h-bar w-1/3 mb-2 m-auto opacity-25"></div>
        <div class="py-3">
            <ul class="list-reset flex justify-center">
                <li class="mr-8"><a class="text-white" href="">Mentions légales</a></li>
                <li class="mr-8"><a class="text-white" href="">|</a></li>
                <li class="mr-8"><a class="text-white" href="">Protection des données</a></li>
                <li class="mr-8"><a class="text-white" href="">|</a></li>
                <li class="mr-8"><a class="text-white" href="">CGV</a></li>
                <li class="mr-8"><a class="text-white" href="">|</a></li>
                <li><a class="text-white" href="">Conditions des offres</a></li>
            </ul>
        </div>
    </div>
</footer>
