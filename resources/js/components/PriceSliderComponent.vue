<template>
    <el-slider  v-show="showFacet"
                range
                :max="facet.values.max">
    </el-slider>
</template>

<script>
    import PriceSliderComponent from './PriceSliderComponent';

    export default {
        components: {PriceSliderComponent},
        props: {
            facet: {
                type: Object,
                required: false
            },
        },
        data() {
            return {
                showFacet: false,
            }
        },
        methods: {
            addFacet(index) {
                this.$emit('addFacet', {name: this.facet.name, value: index});
            }
        }
    }
</script>
