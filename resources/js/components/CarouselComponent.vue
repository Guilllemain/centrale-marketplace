<template>
    <carousel :perPage="5" :navigationEnabled="true" :paginationEnabled="false" :scrollPerPage="false">
      <slide v-for="product in latestProducts" :key="product.productId">
        <div class="flex flex-col items-center px-4">
            <img class="mb-2" :src="`https://back.vegan-place.com/api/v1/image/${product.mainImage.id}?w=200&h=200`">
            <div class="my-2 border-b border-grey-light w-2/3"></div>
            
            <a :href="productPath(product)">
                <h3 class="text-center mb-2">{{ product.name }}</h3>
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
        </div>
      </slide>
    </carousel>
</template>

<script>
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
        methods: {
            productPath(product) {
                if(product.categoryPath.length > 2) {
                    return `/${product.categoryPath[0]['slug']}/${product.categoryPath[1]['slug']}/${product.categoryPath[2]['slug']}/${product.slug}`;
                } else if (product.categoryPath.length > 1){
                    return `/${product.categoryPath[0]['slug']}/${product.categoryPath[1]['slug']}/${product.slug}`;
                } else {
                    return `/${product.categoryPath[0]['slug']}/${product.slug}`;
                }
            }
        },
        async created() {
            const response = await axios.get('/');
            this.latestProducts = response.data.results;
        },
    }
</script>

<style scoped>

</style>
