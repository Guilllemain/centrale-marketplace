<template>
    <div>
        <div class="mt-4 mb-4">
            <div class="flex items-center">
                <h3 class="mb-1 cursor-pointer" @click="showFacet = !showFacet">{{ facet.label }}</h3>
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24">
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
            <div v-else class="mx-2">
                <el-slider  v-show="showFacet"
                            range
                            @change="changePrice"
                            :min="facet.values.min"
                            :max="facet.values.max">
                </el-slider>
            </div>
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