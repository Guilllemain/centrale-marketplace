<template>
    <div>
        <div class="my-2 border-b border-grey-light w-full"></div>
        <div class="mt-4 mb-4">
            <div class="flex items-center justify-between" @click="showFacet = !showFacet">
                <h3 class="uppercase text-sm font-normal mb-1 hover:cursor-pointer">{{ facet.label }}</h3>
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hover:cursor-pointer" viewBox="0 0 24 24">
                        <use v-if="!showFacet" href="/svg/icons.svg#arrow-up"></use>
                        <use v-else href="/svg/icons.svg#arrow-down"></use>
                    </svg>
                </span>
            </div>
            <div v-if="facet.name !== 'price'">
                <transition-group name="fade">
                <div class="mx-2" v-show="showFacet" v-for="(value, index) in facet.values" :key="index+1">
                        <label class="cursor-pointer">
                            <div class="flex items-baseline">
                                <input @change="addFacet(index)" :ref="`checkbox-${index}`" type="checkbox" class="mr-1 font-semibold">
                                <div>
                                    <span :ref="`label-${index}`" class="hover:text-black hover:font-semibold">{{ value.label }}</span>
                                    <span class="ml-1 italic text-xs">({{ value.count }})</span>
                                </div>
                            </div>
                        </label>
                        <!-- <a @click="addFacet(index)" class="block" v-for="(value, index) in facet.values" :key="index">{{ value.label }}
                            <span class="pl-1">({{ value.count }})</span>
                        </a> -->
                </div>
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
        mounted() {
            if(this.facet.name !== 'categories' && this.facet.name !== 'price' && this.facet.name !== '1' && this.facet.name !== 'companies') this.showFacet = false;
        },
        methods: {
            changePrice(event) {
                this.$emit('updatePriceRange', {min: event[0], max: event[1]});
            },
            addFacet(index) {
                if (this.$refs[`checkbox-${index}`][0].checked) {
                    this.$refs[`label-${index}`][0].classList.add('font-semibold');
                    this.$emit('addFacet', {name: this.facet.name, value: index});
                } else {
                    this.$refs[`label-${index}`][0].classList.remove('font-semibold');
                    this.$emit('deleteFacet', {name: this.facet.name, value: index});
                }
            }
        }
    }
</script>

<style scoped>
    .fade-enter-active, .fade-leave-active {
        max-height: 3rem;
        transition: all .3s;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
        opacity: 0;
        max-height: 0;
        transform: scaleY(0);
        transform-origin: top;
    }
</style>