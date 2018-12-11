<template>
    <div class="mx-3 my-6 w-64">
        <img :src="getImage()" class="w-full">
        <h3 class="text-center mt-3">
            <a :href="`/product/${product.productId}`">{{ product.name }}</a>
        </h3>
        <button @click="addToCart()">Add to cart</button>
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
                    return `https://sandbox.wizaplace.com/api/v1/image/${this.product.mainImage.id}`
                }
                return 'https://upload.wikimedia.org/wikipedia/commons/a/ac/No_image_available.svg'
            },
            async addToCart() {
                try {
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
