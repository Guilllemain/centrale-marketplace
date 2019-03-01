<template>
    <div>
        <transition name="zoom" mode="out-in">
            <a v-if="!favorite" class="flex items-center favorite-icon" href="" @click.prevent="addToFavorite" key="add">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6">
                        <use class="text-orange-dark fill-current" href="/svg/icons.svg#favorite"></use>
                    </svg>
            </a>
            <a v-else class="flex items-center favorite-icon" href="" @click.prevent="removeFavorite" key="remove">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6">
                        <use class="text-orange-dark fill-current" href="/svg/icons.svg#favorite-full"></use>
                    </svg>
            </a>
        </transition>
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
        methods: {
            async addToFavorite() {
                try {
                    await axios.post('/favorites/addToFavorites', {
                            declinationId: this.product.declinations[0].id
                        });
                    this.favorite = true;
                    flash('Vous avez ajouté ce produit à vos favoris');
                } catch (error) {
                    flash('Vous devez être connecté pour ajouter un produit dans vos favoris', 'danger');
                    console.log(error);
                }
            },
            async removeFavorite() {
                try {
                    await axios.post('/favorites/removeFavorite', {
                            declinationId: this.product.declinations[0].id
                        })
                    this.favorite = false;
                    flash('Vous avez retiré ce produit de vos favoris');
                } catch (error) {
                    console.log(error);
                }
            }
        }
    }
</script>

<style scoped>
    @keyframes zoomIn {
        0% {
            transform: scale(1);
        }
        50% {
            transform: scale(0.7);
        }
        100% {
            transform: scale(1.3);
        }
    }
    .zoom-enter, .zoom-leave-to {
        animation: zoomIn .4s ease;
        /*transform: scale(1.5);*/
    }
    .favorite-icon {
        transition: all .3s ease-in-out;
    }
    .favorite-icon:hover {
        transform: scale(1.1);
    }
</style>
