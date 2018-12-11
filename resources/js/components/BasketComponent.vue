<template>
    <div>
        <div class="flex items-center" v-for="item in items">
            <h3 class="mr-3">{{ item.productName }}</h3>
            <div>{{ item.quantity }}</div>
        </div>
    </div>
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
        },
        methods: {
            async getBasket() {
                const response = await axios.get('/basket');
                this.basket = response.data;
                console.log(response.data);
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
