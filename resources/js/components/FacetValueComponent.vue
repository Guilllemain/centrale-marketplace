<template>
    <div class="flex items-center">
        <label class="label-cbx" :for="'cbx' + index" :class="{ 'font-semibold': selected }">
            <input v-model="selected" :id="'cbx' + index" type="checkbox" class="hidden invisible">
            <div class="checkbox">
                <svg viewBox="0 0 20 20">
                    <path d="M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19 C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z"></path>
                    <polyline points="4 11 8 15 16 6"></polyline>
                </svg>
            </div>
            <span>{{ value.label }}</span>
        </label>
        <small class="ml-auto text-grey-dark">({{ value.count }})</small>
    </div>

</template>

<script>
    import PriceSliderComponent from './PriceSliderComponent';

    export default {
        components: {PriceSliderComponent},
        props: {
            facet: {
                type: Object,
                required: true
            },
            index: {
                type: String,
                required: true
            },
            value: {
                required: true
            },
        },
        data() {
            return {
                selected: false,
            }
        },
        mounted() {
            if (this.isSelected) this.selected = true;
        },
        computed: {
            isSelected() {
                if (this.selectedFacets.length > 0) {
                    return this.selectedFacets.some(el => el.name === this.facet.name && el.value === this.index);  
                }
                return false;
            },
            selectedFacets() {
                return this.$store.getters.selectedFacets;
            }
        },
        watch: {
            selected(value) {
                if (value && !this.isSelected) {
                    this.$store.commit('addFacet', {name: this.facet.name, value: this.index});
                } else if (!value) {
                    this.$store.commit('deleteFacet', {name: this.facet.name, value: this.index});
                }
            },
            selectedFacets(value) {
                if (value.length == 0) {
                    this.selected = false;
                }
            }
        }
    }
</script>

<style scoped>
    .cbx-container {
        --cbx-size: 12px;
    }
</style>