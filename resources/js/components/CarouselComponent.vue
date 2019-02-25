<template>
    <!-- <el-carousel :interval="5000">
        <el-carousel-item>
            <div class="relative">
                <div class="title text-white uppercase absolute tracking-wide z-10">
                    <h3 class="text-5xl font-hairline tracking-wide">Soldes</h3>
                    <h4 class="text-xl font-light">Jusqu'à -50% de réduction</h4>
                </div>
                <img class="opacity-90 w-full" src="main2.jpg">
            </div>
        </el-carousel-item>
        <el-carousel-item>
            <div class="relative">
                <div class="title text-white uppercase absolute tracking-wide z-10">
                    <h3 class="text-5xl font-hairline tracking-wide">Soldes</h3>
                    <h4 class="text-xl font-light">Jusqu'à -50% de réduction</h4>
                </div>
                <img class="opacity-90 w-full" src="main.jpg">
            </div>
        </el-carousel-item>
        <el-carousel-item>
            <div class="relative">
                <div class="title text-white uppercase absolute tracking-wide z-10">
                    <h3 class="text-5xl font-hairline tracking-wide">Soldes</h3>
                    <h4 class="text-xl font-light">Jusqu'à -50% de réduction</h4>
                </div>
                <img class="opacity-90 w-full" src="main3.jpg">
            </div>
        </el-carousel-item>
    </el-carousel> -->
    <div>
        
            <li class="glide__slide" v-for="product in suggestedProducts" :key="product.productId">
                <img :src="`https://back.vegan-place.com/api/v1/image/${product.mainImage.id}?w=200&h=200`">
            </li>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        data() {
            return {
                suggestedProducts: [],
            }
        },
        computed: {
        },
        async created() {
            const response = await axios.get('/');
            this.suggestedProducts = response.data.results;
        }
    }
</script>

<style scoped>
    .title {
        left: 45%;
        top: 15%;
    }
    .opacity-90 {
        opacity: 0.9;
    }
</style>
