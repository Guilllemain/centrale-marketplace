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
        <div class="footer__list py-8 text-white flex justify-center">
            <div class="flex flex-col mr-8 p-4">
                <h2 class="text-sm uppercase mb-6 font-normal">Aide</h2>
                <a class="text-white font-light translateX hover:text-white hover:font-medium" href="">Questions fréquentes</a>
                <a class="text-white font-light translateX hover:text-white hover:font-medium" href="">Suivre mon colis</a>
                <a class="text-white font-light translateX hover:text-white hover:font-medium" href="">Moyens de paiement</a>
                <a class="text-white font-light translateX hover:text-white hover:font-medium" href="">Retours et remboursements</a>
                <a class="text-white font-light translateX hover:text-white hover:font-medium" href="">10% de réduction avec la newsletter</a>
            </div>
            <div class="flex flex-col p-4">
                <h2 class="text-sm uppercase mb-6 font-normal">Cartes cadeaux</h2>
                <a class="text-white font-light translateX hover:text-white hover:font-medium" href="">Offrir une carte cadeau</a>
                <a class="text-white font-light translateX hover:text-white hover:font-medium" href="">Utiliser une carte cadeau</a>
            </div>
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
