<template>
    <modal name="comparison" :adaptive="true" width="100%" height="auto" :pivotY="1.0" :clickToClose="false">
        <div class="flex justify-around items-center m-6">
            <div v-for="product in products">
                <h3>{{ product.name }}</h3>

                <template v-if="showContent">
                    <div>{{ formatPrice(product.minimumPrice) }}</div>
                    <div>{{ product.shortDescription }}</div>
                </template>
            </div>
        </div>
            <button 
                class="translateY mt-auto focus:outline-none hover:bg-blue bg-blue-dark font-normal text-white hover:text-white py-3 px-3 border hover:border-transparent rounded self-end"
                :disabled="buttonDisabled"
                @click="showFullComparison"
                >
                {{ showContent ? 'Minimiser' : 'Comparer' }}
            </button>
    </modal>
</template>

<script>
    export default {
        data() {
            return {
                showContent: false
            }
        },
        computed: {
            products() {
                return this.$store.getters.comparedProducts;
            },
            buttonDisabled() {
                return this.products.length <= 1;
            }
        },
        methods: {
            showFullComparison() {
                this.showContent = !this.showContent;
            },
            formatPrice(price) {
                price = price.toFixed(2) + '';
                return price.replace('.', ',');
            },
        }
    }
</script>

<style scoped>
    button[disabled] {
        background-color: lightgrey;
        opacity: .7;
    }
    .v--modal-overlay {
      background: transparent;
      height: auto;
    }
</style>
