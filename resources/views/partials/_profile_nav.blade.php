<div class="w-1/4 mr-16">
    <div class="flex flex-col bg-white shadow-md rounded px-8 pt-6 pb-8 profile__menu">
        <div class="mb-4">
            <a class="uppercase hover:border-b hover:border-black font-light" href="{{ route('profile.show', $user->id) }}">Mes informations personnelles</a>
        </div>
        <div class="mb-4">
            <a class="uppercase hover:border-b hover:border-black font-light" href="{{ route('profile.orders', $user->id) }}">Mes commandes</a>
        </div>
        <div class="mb-4">
            <a class="uppercase hover:border-b hover:border-black font-light" href="{{ route('profile.addresses', $user->id) }}">Mes adresses</a>
        </div>
        <div class="mb-4">
            <a class="uppercase hover:border-b hover:border-black font-light" href="/profile/newsletter">Newsletter</a>
        </div>
        <div>
            <a class="uppercase hover:border-b hover:border-black font-light" href="/profile/messages">Mes messages</a>
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