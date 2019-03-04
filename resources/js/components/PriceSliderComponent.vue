<template>
    <div>
        <el-slider  range
                    @change="changePrice"
                    v-model="range"
                    :min="facet.values.min"
                    :max="facet.values.max"
                    >
        </el-slider>
        <div>De {{ formatPrice(range[0]) }} à {{ formatPrice(range[1]) }}</div>
    </div>
</template>

<script>
    export default {
        props: {
            facet: {
                type: Object,
                required: false
            },
        },
        data() {
            return {
                range: []
            }
        },
        created() {
            this.range = [this.facet.values.min, this.facet.values.max];
        },
        methods: {
            changePrice(event) {
                this.$emit('updatePriceRange', {min: event[0], max: event[1]});
            },
        }
    }
</script>

<style>
    .el-slider__button-wrapper {
        z-index: 10;
    }
</style>
