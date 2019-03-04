<template>
    <div class="basket ml-8">
        <div class="relative">
            <span v-show="items.length > 0" class="absolute pin-r pin-t">
                <el-badge :value="basket.totalQuantity"></el-badge>
            </span>
            <a class="flex flex-col items-center" href="/basket">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24">
                    <path class="text-orange-dark fill-current" d="M17.21 9l-4.38-6.56c-.19-.28-.51-.42-.83-.42-.32 0-.64.14-.83.43L6.79 9H2c-.55 0-1 .45-1 1 0 .09.01.18.04.27l2.54 9.27c.23.84 1 1.46 1.92 1.46h13c.92 0 1.69-.62 1.93-1.46l2.54-9.27L23 10c0-.55-.45-1-1-1h-4.79zM9 9l3-4.4L15 9H9zm3 8c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z"/>
                    <path d="M0 0h24v24H0z" fill="none"/>
                </svg>
                <h4 class="font-normal opacity-75">Mon panier</h4>
            </a>
        </div>
        <div class="basket__content min-w-64">
            <div v-if="items.length > 0">
                <h3 class="uppercase text-center mb-4">Mon panier</h3>
                <div v-for="item in items" :key="item.productId + Math.random()">
                    <div class="mb-2 flex items-center">
                        <div class="w-1/5 mr-4">
                            <img class="w-full" :src="getImage(item.mainImage)">
                        </div>
                        <div class="flex-1">
                            <a :href="item.productUrl">{{ item.productName }}</a>
                            <div class="text-grey-dark">Quantité: {{ item.quantity }}</div>
                        </div>
                        <div class="text-right ml-2">
                            <p>{{ formatPrice(item.totalPrice.priceWithTaxes) }}</p>
                        </div>
                    </div>
                    <div class="my-2 border-b border-grey-light w-full"></div>
                </div>
                <div class="flex justify-between mb-2 text-grey-dark">
                    <p>Livraison</p>
                    <p>à partir de {{ formatPrice(basket.totalShipping) }}</p>
                </div>
                <div class="flex justify-between font-bold">
                    <p>Total</p>
                    <p>{{ formatPrice(basket.total) }}</p>
                </div>
                <a href="/basket/address" class="focus:outline-none translateY mt-4 block text-center bg-orange-dark hover:bg-orange hover:text-white text-white font-bold py-2 px-4 rounded">Commander</a>
                <a href="/basket" class="mt-4 block text-center font-bold py-2 px-4 hover:text-grey-dark">Voir mon panier</a>
            </div>
            <p v-else class="text-center">Votre panier est vide</p>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        data() {
            return {
            }
        },
        mounted() {
            this.$store.dispatch('getBasketContent');
        },
        computed: {
            basket() {
                return this.$store.getters.basketContent;
            },
            items() {
                if (this.basket) {
                    return this.basket.companyGroups.flatMap(company => {
                        return company.shippingGroups.flatMap(group => group.items.map(item => item))
                    });
                }
                return [];
            }
        },
        methods: {
            getImage(image) {
                if (image) {
                    return `${process.env.MIX_MARKETPLACE_BASE_URI}image/${image.id}?w=200&h=200`
                }
                return 'https://upload.wikimedia.org/wikipedia/commons/a/ac/No_image_available.svg'
            },
        }
    }
</script>
