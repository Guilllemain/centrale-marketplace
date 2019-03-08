<template>
    <div class="flex flex-col items-center justify-center w-full bg-white rounded overflow-hidden">
        <h2 class="uppercase font-light w-full bg-orange-lighter text-center p-4 tracking-wide">Créer son compte</h2>
        <form @submit.prevent="register" class="w-full px-12 py-4 text-sm">
            <div class="py-4">
                <input type="email"
                       class="appearance-none border rounded w-full p-3 text-grey-darker leading-tight focus:outline-none focus:border-grey"
                       name="email"
                       placeholder="Votre adresse email"
                       v-model="user.email"
                       required>
                <div v-if="errors && errors.email" class="text-xs text-red">{{ errors.email[0] }}</div>
            </div>
            <div class="py-4">
                <input type="password"
                       class="appearance-none border rounded w-full p-3 text-grey-darker leading-tight focus:outline-none focus:border-grey"
                       name="password"
                       placeholder="Votre mot de passe"
                       v-model="user.password"
                       required>
                <div v-if="errors && errors.password" class="text-xs text-red">{{ errors.password[0] }}</div>
            </div>
            <div class="py-4">
                <input type="password"
                       class="appearance-none border rounded w-full p-3 text-grey-darker leading-tight focus:outline-none focus:border-grey"
                       name="password_confirmation"
                       placeholder="Confirmez votre mot de passe"
                       v-model="user.password_confirmation"
                       required>
            </div>
            <div class="py-4 flex justify-between text-grey-dark">
                <label for="terms" class="cursor-pointer">
                    <input class="mr-2" id="terms" type="checkbox"/>
                    <span>J'accepte les conditions d'utilisation du site</span>
                </label>
            </div>
            <div class="py-4">
                <button class="translateY hover:bg-orange text-white w-full bg-orange-dark  p-3 uppercase rounded tracking-wide focus:outline-none">Valider</button>
            </div>
            <div class="text-center">
                <a href="" @click.prevent="$emit('showLogin')" class="text-grey-dark">Revenir à la connexion</a>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            user: {
                email: '',
                password: '',
                password_confirmation: ''
            },
            errors: []
        }
    },
    methods: {
        async register() {
            try {
                await axios.post('/register', this.user);
                location.reload();
            } catch (error) {
                console.error(error);
                if (error.response.status === 422) {
                    this.errors = error.response.data.errors || {};
                }
            }
        }
    }
}
</script>

