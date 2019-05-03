<template>
        <div class="ml-2 flex items-center relative mr-8">
            <select @change="updateQty" v-model="quantity" class="block appearance-none bg-white border border-grey-light hover:border-grey px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none" name="quantity">
                <option v-for="i in 30" :value="i">{{i}}</option>
            </select>
            <div class="pointer-events-none absolute pin-y pin-r flex items-center px-2 text-grey-darker">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                </svg>
            </div>
        </div>
</template>

<script>
    export default {
        props: {
            product: {
                type: Object,
                required: true
            },
            name: {
                type: String,
                required: true
            }
        },
        data() {
            return {
                quantity: this.product.quantity
            }
        },
        methods: {
            async updateQty() {
                try {
                    await axios.post('/basket/update', {
                        basketId: this.$store.getters.basketContent.id,
                        declinationId: this.product.declinationId,
                        quantity: this.quantity
                    });
                    flash(`La quantité de ${this.name} a été modifiée`);
                    this.$store.dispatch('getBasketContent');
                } catch (error) {
                    console.log(error);
                }
            }
        }
    }
</script>
