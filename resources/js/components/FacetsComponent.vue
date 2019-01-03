<template>
    <div>
        <div class="my-2 border-b border-grey-light w-full"></div>
        <div class="mt-4 mb-4">
            <div class="flex items-center justify-between">
                <h3 class="uppercase text-sm font-normal mb-1 cursor-pointer" @click="showFacet = !showFacet">{{ facet.label }}</h3>
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24">
                        <use v-if="!showFacet" href="/svg/icons.svg#arrow-up"></use>
                        <use v-else href="/svg/icons.svg#arrow-down"></use>
                    </svg>
                </span>
            </div>
            <div v-if="facet.name !== 'price'">
                <div class="mx-2" v-show="showFacet" v-for="(value, index) in facet.values" :key="index">
                        <label class="cursor-pointer">
                            <input @change="addFacet(index)" :ref="`checkbox-${index}`" type="checkbox" class="mr-1">{{ value.label }}<span class="pl-1">({{ value.count }})</span>
                        </label>
                        <!-- <a @click="addFacet(index)" class="block" v-for="(value, index) in facet.values" :key="index">{{ value.label }}
                            <span class="pl-1">({{ value.count }})</span>
                        </a> -->
                </div>
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
                showFacet: true,
            }
        },
        methods: {
            changePrice(event) {
                this.$emit('updatePriceRange', {min: event[0], max: event[1]});
            },
            addFacet(index) {
                if (this.$refs[`checkbox-${index}`][0].checked) {
                    this.$emit('addFacet', {name: this.facet.name, value: index});
                } else {
                    this.$emit('deleteFacet', {name: this.facet.name, value: index});
                }
            }
        }
    }
</script>

<style scoped>
    .fade-enter-active, .fade-leave-active {
      transition: all .5s;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
        transform: scaleY(0);
        transform-origin: top;
    }
</style>