<template>
    <div v-if="items.length > 0">
        <div class="flex items-center" v-for="item in items">
            <h3 class="mr-3">{{ item.productName }}</h3>
            <div class="mr-3">{{ item.quantity }}</div>
            <div class="ml-auto">{{ item.totalPrice.priceWithTaxes }} €</div>
        </div>
        <a href="/basket" class="mt-2 block text-center bg-blue hover:bg-blue-dark hover:text-white text-white font-bold py-3 px-4 rounded">Voir mon panier</a>
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
