<template>
    <div class="flex flex-col items-center justify-center w-full bg-white rounded overflow-hidden">
        <h2 class="uppercase font-light w-full bg-orange-lighter text-center p-4 tracking-wide">Se connecter</h2>
        <form @submit.prevent="login" class="w-full px-12 py-4 text-sm">
            <div class="py-4">
                <input type="email"
                       class="appearance-none border rounded w-full p-3 text-grey-darker leading-tight focus:outline-none focus:border-grey"
                       name="email"
                       placeholder="Votre adresse email"
                       v-model="user.email"
                       required>
            </div>
            <div class="py-4">
                <input type="password"
                       class="appearance-none border rounded w-full p-3 text-grey-darker leading-tight focus:outline-none focus:border-grey"
                       name="password"
                       placeholder="Votre mot de passe"
                       v-model="user.password"
                       required>
            </div>
            <div class="py-4 flex justify-between text-grey-dark">
                <label for="signIn" class="cursor-pointer">
                    <input class="mr-2" id="signIn" type="checkbox"/>
                    <span>Se souvenir de moi</span>
                </label>
                <a href="" @click.prevent="$emit('forgotPassword')" class="text-grey-dark">Mot de passe oublié ?</a>
            </div>
            <div class="py-4">
                <button type="submit" class="translateY hover:bg-orange text-white w-full bg-orange-dark  p-3 uppercase rounded tracking-wide focus:outline-none">Connection</button>
            </div>
            <div class="text-center">
                <a href="" @click.prevent="$emit('showRegister')" class="text-grey-dark">Se créer un compte</a>
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
                password: ''
            },
            errors: []
        }
    },
    methods: {
        async login() {
            try {
                await axios.post('/login', this.user);
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

