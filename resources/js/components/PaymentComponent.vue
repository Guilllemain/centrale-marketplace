<template>
    <div class="flex">
        <form class="my-form" action="/payment" method="post">
            @csrf
          <input type="hidden" name="token" id="token">
          <label>
            <span>First Name</span>
            <input class="inp-first-name" name="first_name">
          </label>
          <label>
            <span>Last Name</span>
            <input class="inp-last-name" name="last_name">
          </label>
          <fieldset>
            <legend>Address</legend>
            <label>
              <span>Street Address Line 1</span>
              <input class="inp-street-address1" name="street_address1">
            </label>
            <label>
              <span>City</span>
              <input class="inp-city" name="city">
            </label>
            <label>
              <span>Postal Code</span>
              <input class="inp-zip" name="zip">
            </label>
          </fieldset>
          <p>En cliquant sur ce bouton, vous acceptez <a href="#">nos Conditions Générales d'Utilisation</a> ainsi que les <a href="/connect-account/legal">Conditions d'Utilisation des Comptes Connectés Stripe</a></p>
          <button id="btn-submit" type="button">Submit</button>
        </form>
    </div>
</template>

<script>
    const stripe = Stripe('pk_test_urL29gD8B9Z4XWHunuMswDKk');
    
    export default {
        data() {
            return {
            }
        },
        methods: {
            updateCity(event) {
                this.cities = event;
            }
        }
    }
</script>
