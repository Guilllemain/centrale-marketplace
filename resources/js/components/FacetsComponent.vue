<template>
    <div>
        <div v-if="facet.label !== 'Prix'" class="mt-4 mb-4">
            <div class="flex items-center">
                <h3 class="mb-1 cursor-pointer" @click="showFacet = !showFacet">{{ facet.label }}</h3>
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24">
                        <use v-if="!showFacet" href="/svg/icons.svg#arrow-up"></use>
                        <use v-else href="/svg/icons.svg#arrow-down"></use>
                    </svg>
                </span>
            </div>
            <div class="mx-2" v-show="showFacet">
                <a @click="addFacet(index)" class="block" v-for="(value, index) in facet.values" :key="index">{{ value.label }}
                    <span class="pl-1">({{ value.count }})</span>
                </a>
            </div>
        </div>
        <div v-else>
            <h3 class="mb-1 cursor-pointer" @click="showFacet = !showFacet">{{ facet.label }}</h3>
            <el-slider  v-show="showFacet"
                        range
                        :max="facet.values.max">
            </el-slider>
        </div>
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
