<template>
    <div class="flex flex-col items-center justify-center w-full bg-white rounded overflow-hidden">
        <h2 class="uppercase font-light w-full bg-orange-lighter text-center p-4 tracking-wide">Mot de passe oublié</h2>
        <form @submit.prevent="recoverPassword" class="w-full px-12 py-4 text-sm">
            <div class="py-4">
                <input type="email"
                       class="appearance-none border rounded w-full p-3 text-grey-darker leading-tight focus:outline-none focus:border-grey"
                       name="email"
                       placeholder="Votre adresse email"
                       v-model="email"
                       required>
            </div>
            <div class="py-4">
                <button class="translateY hover:bg-orange text-white w-full bg-orange-dark  p-3 uppercase rounded tracking-wide focus:outline-none">Réinitialiser mon mot de passe</button>
            </div>
            <div class="text-center">
                <a href="" @click.prevent="$emit('showLogin')" class="text-grey-dark">Revenir à la connection</a>
            </div>
        </form>
    </div>
</template>

<script>
import axios from 'axios'

export default {
    data() {
        return {
            email: ''
        }
    },
    methods: {
        async recoverPassword() {
            try {
                const response = await axios.post('/users/password', this.email);
            } catch (error) {
                console.error(error);
            }
        }
    }
}
</script>
