<template>
    <el-carousel :interval="5000">
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
    </el-carousel>
</template>

<script>
    export default {
        data() {
            return {
                title: 'Profitez de nos dernières arrivées'
            }
        },
        methods: {
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
