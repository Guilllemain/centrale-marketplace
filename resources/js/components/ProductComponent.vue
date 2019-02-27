<template>
    <div class="list-product mx-3 my-4 flex flex-col items-center justify-center bg-white pb-4 rounded">
        <div class="bg-white product__image">
            <img :src="getImage()" class="w-full">
        </div>
        <div class="my-2 border-b border-grey-light w-5/6"></div>
        <a :href="productPath()" class="px-3 mb-2">
            <h3>{{ product.name }}</h3>
        </a>
        <div class="mb-2">
            <div v-if="product.crossedOutPrice" class="flex-col flex items-center">
                <div class="text-red-dark">{{ formatPrice(product.minimumPrice) }}</div>
                <div class="text-xs line-through">{{ formatPrice(product.crossedOutPrice) }}</div>
            </div>
            <div v-else>
                <div>{{ formatPrice(product.minimumPrice) }}</div>
            </div>
        </div>
        <button class="translateY mt-auto focus:outline-none hover:bg-grey-dark text-grey hover:text-white py-2 px-3 border hover:border-transparent rounded" @click="addToCart">Ajouter au panier</button>
        <compare-checkbox-component :product="product"></compare-checkbox-component>
    </div>
</template>

<script>
    import axios from 'axios';
    import CompareCheckboxComponent from './compareCheckboxComponent';

    export default {
        components: {CompareCheckboxComponent},
        props: {
            product: {
                type: Object,
                required: true
            }
        },
        methods: {
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
            async addToCart(event) {
                try {
                    await axios.post('/basket/add', {
                        declinationId: this.product.mainDeclination.id,
                        quantity: 1
                    });
                    flash(`${this.product.name} a été ajouté à votre panier`);
                    this.$store.dispatch('getBasketContent');
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
    .compareCheckbox {
        opacity: .5;
        cursor: not-allowed;
    }
</style>
