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
            productId: {
                required: true,
                type: Number
            }
        },
        data() {
            return {
                favorite: false
            }
        },
        async mounted() {
            const result = await axios.post(`/favorites/isFavorited`, {
                declinationId: this.productId
            });
            this.favorite = result.data;
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
                        declinationId: this.productId
                    })
                this.favorite = true;
            },
            async removeFavorite() {
                await axios.post('/favorites/removeFavorite', {
                        declinationId: this.productId
                    })
                this.favorite = false;
            }
        }
    }
</script>
