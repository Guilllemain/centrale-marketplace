<ul class="list-unstyled multi-steps">
    <li>
        <a href="/basket">Panier</a>
    </li>
    <li @if($steps === 2) class="is-active" @endif>
        <a href="/basket/address">Livraison</a>
    </li>
    <li @if($steps === 3) class="is-active" @endif>
        Paiement
    </li>
</ul>