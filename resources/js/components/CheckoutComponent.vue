<template>
    <div class="flex">
        <form @submit.prevent="handleForm" class="my-form" action="/checkout" method="post">
            <input type="hidden" name="_token" :value="csrf">
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
            <button type="submit">Submit</button>
        </form>
    </div>
</template>

<script>
    // const stripe = Stripe('pk_test_urL29gD8B9Z4XWHunuMswDKk');

    export default {
        data() {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        },
        methods: {
            async handleForm(event) {
                event.target.submit();
                // event.preventDefault();

                // const result = await stripe.createToken('account', {
                //     legal_entity: {
                //         first_name: document.querySelector('.inp-first-name').value,
                //         last_name: document.querySelector('.inp-last-name').value,
                //         address: {
                //             line1: document.querySelector('.inp-street-address1').value,
                //             city: document.querySelector('.inp-city').value,
                //             postal_code: document.querySelector('.inp-zip').value,
                //         },
                //     },
                //     tos_shown_and_accepted: true,
                // });
                // console.log(result);
                // if (result.token) {
                //     document.querySelector('#token').value = result.token.id;
                //     event.target.submit();
                // }
            }
        }
    }
</script>
