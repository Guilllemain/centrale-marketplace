<template>
    <div v-if="items.length > 0">
        <div class="my-2 flex items-center" v-for="item in items">
            <div class="flex flex-1">
                <h4>{{ item.productName }}</h4>
            </div>
            <div class="w-1/5">
                <p class="mx-4">{{ item.quantity }}</p>
            </div>
            <div class="w-1/5 text-right">
                <p>{{ item.totalPrice.priceWithTaxes }} €</p>
            </div>
        </div>
        <a href="/basket" class="mt-4 block text-center bg-blue hover:bg-blue-dark hover:text-white text-white font-bold py-2 px-4 rounded">Voir mon panier</a>
    </div>
    <div v-else>Votre panier est vide</div>
</template>

<script>
    import axios from 'axios';

    export default {
        data() {
            return {
                basket: {},
                items: []
            }
        },
        mounted() {
            this.getBasket();
            // Event.$on('addItemToCart', () => this.getBasket());
        },
        methods: {
            async getBasket() {
                const response = await axios.get('/basket');
                this.basket = response.data;
                await this.getItems()
            },
            getItems() {
                this.basket.companyGroups.forEach(company => 
                    company.shippingGroups.forEach(group => 
                        group.items.forEach(item => 
                            this.items.push(item))))
            }
        }
    }
</script>
