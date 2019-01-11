<template>
    <div>
        <a v-if="!favorite" class="flex items-center" href="" @click.prevent="addToFavorite">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6">
                <use class="text-orange-dark fill-current" href="/svg/icons.svg#favorite"></use>
            </svg>
        </a>
        <a v-else class="flex items-center" href="" @click.prevent="removeFavorite">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6">
                <use class="text-orange-dark fill-current" href="/svg/icons.svg#favorite-full"></use>
            </svg>
        </a>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        props: {
            product: {
                required: true,
                type: Object
            },
            auth: {
                required: false,
                type: Number
            }
        },
        data() {
            return {
                favorite: 0
            }
        },
        async mounted() {
            if (this.auth) {
                const result = await axios.post(`/favorites/isFavorited`, {
                    declinationId: this.product.declinations[0].id
                });
                this.favorite = result.data;
            }
        },
        // computed: {
        //     async isFavorited() {
        //         const result = await axios.get(`/favorites/isFavorited/${this.productId}`);
        //         return result.data;
        //     }
        // },
        methods: {
            async addToFavorite() {
                await axios.post('/favorites/addToFavorites', {
                        declinationId: this.product.declinations[0].id
                    })
                this.favorite = true;
            },
            async removeFavorite() {
                await axios.post('/favorites/removeFavorite', {
                        declinationId: this.this.product.declinations[0].id
                    })
                this.favorite = false;
            }
        }
    }
</script>
