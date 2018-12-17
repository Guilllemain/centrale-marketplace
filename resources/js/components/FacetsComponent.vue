<template>
    <div class="mt-4 mb-4">
        <h3 class="mb-1">{{ facet.label }}</h3>
        <a @click="testFacet(index)" class="block" v-for="(value, index) in facet.values" :key="index">{{ value.label }}
            <span class="pl-1">({{ value.count }})</span>
        </a>
    </div>
</template>

<script>
    export default {
        props: {
            facet: {
                type: Object,
                required: false
            },
            facetIndex: {
                type: Number,
                required: true
            }
        },
        data() {
            return {
            }
        },
        methods: {
            testFacet(index) {
                this.$emit('addFacet', index, this.facetIndex);
            }
        }
    }
</script>
