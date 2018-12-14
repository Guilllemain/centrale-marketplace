<template>
    <div class="mx-8 mt-3 mb-12 w-64 flex flex-col items-center justify-center">
        <img :src="getImage()" class="w-full">
        <div class="my-2 border-b border-grey-light w-5/6"></div>
        <a :href="`/product/${product.productId}`">
            <h3 class="mb-2">{{ product.name }}</h3>
        </a>
        <div class="mb-2">{{ product.minimumPrice }}€</div>
        <button @click="addToCart()">Ajouter au panier</button>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        props: {
            product: Object
        },
        data() {
            return {
            }
        },
        methods: {
            getImage() {
                if (this.product.mainImage) {
                    return `https://back.vegan-place.com/api/v1/image/${this.product.mainImage}?w=256&h=256`
                }
                return 'https://upload.wikimedia.org/wikipedia/commons/a/ac/No_image_available.svg'
            },
            async addToCart() {
                try {
                    // Event.$emit('add-to-cart');
                    const response = await axios.get('/basket/add', {
                        params: {
                            declinationId: this.product.productId,
                            quantity: 1
                        }
                    });
                } catch (error) {
                    console.log(error);
                }
            }
        }
    }
</script>
