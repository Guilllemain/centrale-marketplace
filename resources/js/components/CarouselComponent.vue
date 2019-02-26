<template>
    <carousel :perPage="5" :navigationEnabled="true" :paginationEnabled="false" :scrollPerPage="false">
      <slide v-for="(product, index) in latestProducts" :key="product.productId">
        <div class="flex flex-col items-center">
            <img class="mb-2" :src="`https://back.vegan-place.com/api/v1/image/${product.mainImage.id}?w=200&h=200`">
            <h3 class="mb-2">{{ product.name }}</h3>
            <div class="my-2 border-b border-grey-light w-2/3"></div>
            
            <div class="mb-2">
                <div v-if="product.crossedOutPrice" class="flex-col flex items-center">
                    <div class="text-red-dark">{{ formatPrice(product.minimumPrice) }}</div>
                    <div class="text-xs line-through">{{ formatPrice(product.crossedOutPrice) }}</div>
                </div>
                <div v-else>
                    <div>{{ formatPrice(product.minimumPrice) }}</div>
                </div>
            </div>
        </div>
      </slide>
    </carousel>
</template>

<script>
    import axios from 'axios';
    import { Carousel, Slide } from 'vue-carousel';

    export default {
        components: {
            Carousel,
            Slide
        },
        data() {
            return {
                latestProducts: [],
            }
        },
        computed: {
        },
        async created() {
            const response = await axios.get('/');
            this.latestProducts = response.data.results;
        },
        methods: {
            formatPrice(price) {
                price = price.toFixed(2) + '';
                return price.replace('.', ',') + ' €';
            },
        }
    }
</script>

<style scoped>

</style>
