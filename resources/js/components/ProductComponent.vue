<template>
    <div class="list-product m-3 flex flex-col items-center justify-center bg-white pb-4 shadow rounded">
        <div class="bg-white product__image">
            <img :src="getImage()" class="w-full">
        </div>
        <div class="my-2 border-b border-grey-light w-5/6"></div>
        <a :href="productPath()" class="px-3 mb-2">
            <h3>{{ product.name }}</h3>
        </a>
        <div class="mb-2">
            <div v-if="product.crossedOutPrice" class="flex-col flex items-center">
                <div class="text-red-dark">{{ formatPrice(product.minimumPrice) }} €</div>
                <div class="text-xs line-through">{{ formatPrice(product.crossedOutPrice) }} €</div>
            </div>
            <div v-else>
                <div>{{ formatPrice(product.minimumPrice) }} €</div>
            </div>
        </div>
        <button class="translateY mt-auto focus:outline-none hover:bg-grey-dark text-grey hover:text-white py-2 px-3 border hover:border-transparent rounded" @click="addToCart">Ajouter au panier</button>
        <label class="text-xs mt-3 cursor-pointer" :class="{ 'opacity-50': isDisabled }" :for="'compare' + product.productId">
            <input v-model="isCompared" :disabled="isDisabled" :id="'compare' + product.productId" type="checkbox" class="mr-1 focus:outline-none">
            Comparer
        </label>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        props: {
            product: {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                isCompared: false
            }
        },
        computed: {
            isDisabled() {
                if (!this.isCompared) {
                    return this.$store.getters.comparedProducts.length >= 2;
                }
                return false
            },
            idProductCompared() {
                if (this.isCompared & this.$store.getters.comparedProducts.length === 0) {
                    return this.isCompared = false;
                }
            }
        },
        watch: {
            isCompared(value) {
                if (value) {
                    this.$store.commit('addProductToCompare', this.product);
                    this.$modal.show('comparison');
                } else {
                    this.$store.commit('removeProductFromCompare', this.product);
                    if (this.$store.getters.comparedProducts.length === 0) this.$modal.hide('comparison');
                }
            } 
        },
        methods: {
            // show () {
            //     if (this.checked) {
            //         this.$store.commit('addProductToCompare', this.product);
            //         this.$modal.show('comparison');
            //     } else {
            //         this.$store.commit('removeProductFromCompare', this.product);
            //         if (this.$store.getters.comparedProducts.length === 0) this.$modal.hide('comparison');
            //     }
            // },
            getImage() {
                if (this.product.mainImage) {
                    return `${process.env.MIX_MARKETPLACE_BASE_URI}image/${this.product.mainImage['id']}?w=432&h=432`
                }
                return 'https://upload.wikimedia.org/wikipedia/commons/a/ac/No_image_available.svg'
            },
            productPath() {
                if(this.product.categoryPath.length > 2) {
                    return `/${this.product.categoryPath[0]['slug']}/${this.product.categoryPath[1]['slug']}/${this.product.categoryPath[2]['slug']}/${this.product.slug}`;
                } else if (this.product.categoryPath.length > 1){
                    return `/${this.product.categoryPath[0]['slug']}/${this.product.categoryPath[1]['slug']}/${this.product.slug}`;
                } else {
                    return `/${this.product.categoryPath[0]['slug']}/${this.product.slug}`;
                }
            },
            formatPrice(price) {
                price = price.toFixed(2) + '';
                return price.replace('.', ',');
            },
            async addToCart(event) {
                try {
                    await axios.post('/basket/add', {
                        declinationId: this.product.mainDeclination.id,
                        quantity: 1
                    });
                    flash(`${this.product.name} a été ajouté à votre panier`);
                    // Event.$emit('addItemToCart');
                } catch (error) {
                    console.log(error);
                }
            }
        }
    }
</script>

<style scoped>
    .product__image {
        width: 216px;
        height: 216px;
    }
    .list-product {
        transition: all .3s;
    }

    .list-product:hover {
        transform: scale(1.05);
    }
</style>
