<template>
    <div>
        <div v-if="facet.label !== 'Prix'" class="mt-4 mb-4">
            <h3 class="mb-1 cursor-pointer" @click="showFacet = !showFacet">{{ facet.label }}</h3>
            <a v-show="showFacet" @click="addFacet(index)" class="block" v-for="(value, index) in facet.values" :key="index">{{ value.label }}
                <span class="pl-1">({{ value.count }})</span>
            </a>
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
