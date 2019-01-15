<template>
    <div class="list-product m-3 flex flex-col items-center justify-center bg-white pb-4 shadow rounded">
        <img :src="getImage()" class="w-full">
        <div class="my-2 border-b border-grey-light w-5/6"></div>
        <a :href="productPath()" class="px-2 mb-2">
            <h3>{{ product.name }}</h3>
        </a>
        <div class="mb-2">{{ formatPrice(product.minimumPrice) }} €</div>
        <button @click="addToCart">Ajouter au panier</button>
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
            }
        },
        methods: {
            getImage() {
                if (this.product.mainImage) {
                    return `https://back.vegan-place.com/api/v1/image/${this.product.mainImage['id']}?w=256&h=256`
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
            async addToCart() {
                try {
                    const response = await axios.post('/basket/add', {
                        declinationId: this.product.mainDeclination.id,
                        quantity: 1
                    });
                    // Event.$emit('addItemToCart');
                } catch (error) {
                    console.log(error);
                }
            }
        }
    }
</script>

<style scoped>
    .list-product {
        transition: all .3s;
    }

    .list-product:hover {
        transform: scale(1.05);
    }
</style>
