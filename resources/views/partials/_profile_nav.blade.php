<div class="w-1/4 mr-16">
    <div class="flex flex-col bg-white shadow-md rounded px-8 pt-6 pb-8 profile__menu">
        <div class="mb-4">
            <a class="inline-block uppercase font-light" href="{{ route('profile.show') }}">Mes informations personnelles</a>
        </div>
        <div class="mb-4">
            <a class="inline-block uppercase font-light" href="{{ route('profile.orders') }}">Mes commandes</a>
        </div>
        <div class="mb-4">
            <a class="inline-block uppercase font-light" href="{{ route('profile.addresses') }}">Mes adresses</a>
        </div>
        <div class="mb-4">
            <a class="inline-block uppercase font-light" href="{{ route('profile.favorites') }}">Mes articles préférés</a>
        </div>
        <div class="mb-4">
            <a class="inline-block uppercase font-light" href="{{ route('profile.subscriptions') }}">Newsletter</a>
        </div>
        <div>
            <a class="inline-block uppercase font-light" href="/profile/messages">Mes messages</a>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        const tabs = document.querySelectorAll('.profile__menu a');
        const href = window.location.href;
        
        tabs.forEach(tab => {
            // if(tab.className === 'font-bold') {
            //     tab.classList.remove('font-bold');
            //     tab.classList.add('font-light');
            // }
            if (tab.href === href) {
                tab.classList.remove('font-light');
                tab.classList.add('font-bold');
            }
        })
    </script>
@endpush