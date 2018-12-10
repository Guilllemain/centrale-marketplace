<template>
    <div class="mx-3 my-6 w-64">
        <img :src="getImage()" class="w-full">
        <h3 class="text-center mt-3">
            <a :href="`/product/${product.productId}`">{{ product.name }}</a>
        </h3>
    </div>
</template>

<script>
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
            }
        }
    }
</script>
