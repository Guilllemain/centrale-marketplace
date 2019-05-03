<template>
    <a class="flex flex-col items-center" @click="logout">
        <h4 class="font-normal">Me déconnecter</h4>
    </a>
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
        async logout() {
            try {
                const response = await axios.post('/logout');
                if (response.status === 200) {
                    this.$store.dispatch('clearBasket');
                }
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

