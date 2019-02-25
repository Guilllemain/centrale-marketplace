<template>
    <div>
        <div class="my-2 border-b border-grey-light w-full"></div>
        <div class="mt-4 mb-4">
            <div class="flex items-center justify-between" @click="showFacet = !showFacet">
                <h3 class="uppercase text-sm font-normal mb-1 cursor-pointer">{{ facet.label }}</h3>
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 cursor-pointer" viewBox="0 0 24 24">
                        <use v-if="!showFacet" href="/svg/icons.svg#arrow-up"></use>
                        <use v-else href="/svg/icons.svg#arrow-down"></use>
                    </svg>
                </span>
            </div>
            <div v-if="facet.name !== 'price'">
                <transition-group name="fade" appear>
                    <facet-value-component class="mx-2 cbx-container" :facet="facet" :value="value" :index="index" v-show="showFacet" v-for="(value, index) in facet.values" :key="index+1"></facet-value-component>
                </transition-group>
            </div>
            
            <div v-else class="mx-2 pr-4 w-full">
                <transition name="fade">
                    <price-slider-component @updatePriceRange="$emit('updatePriceRange', $event)" v-show="showFacet" :facet="facet"></price-slider-component>
                </transition>
            </div>

        </div>
    </div>
</template>

<script>
    import PriceSliderComponent from './PriceSliderComponent';
    import FacetValueComponent from './FacetValueComponent';

    export default {
        components: {PriceSliderComponent, FacetValueComponent},
        props: {
            facet: {
                type: Object,
                required: false
            },
        },
        data() {
            return {
                showFacet: true,
            }
        },
        mounted() {
            if(this.facet.name !== 'categories' && this.facet.name !== 'price' && this.facet.name !== '1' && this.facet.name !== 'companies') this.showFacet = false;
        },
        methods: {
            changePrice(event) {
                this.$emit('updatePriceRange', {min: event[0], max: event[1]});
            },
        }
    }
</script>

<style scoped>
    .fade-enter-active, .fade-leave-active {
        max-height: 3rem;
        transition: all .3s;
    }
    .fade-enter, .fade-leave-to {
        opacity: 0;
        max-height: 0;
    }
    .cbx-container {
        --cbx-size: 12px;
    }
</style>