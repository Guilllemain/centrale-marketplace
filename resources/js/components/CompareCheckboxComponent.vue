<template>
    <div class="mt-3 cbx-container" :class="{ 'is-disabled': isDisabled }">
        <label :for="'cbx' + product.productId" class="label-cbx">
            <input v-model="isChecked" :disabled="isDisabled" :id="'cbx' + product.productId" type="checkbox" class="hidden invisible">
            <div class="checkbox">
                <svg viewBox="0 0 20 20">
                    <path d="M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19 C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z"></path>
                    <polyline points="4 11 8 15 16 6"></polyline>
                </svg>
            </div>
            <span>Comparer</span>
        </label>
    </div>
</template>

<script>
    export default {
        props: {
            product: {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                isChecked: false,
            }
        },
        mounted() {
            if (this.isCompared) this.isChecked = true;
        },
        computed: {
            isCompared() {
                if (this.productsList > 0) {
                    return this.$store.getters.comparedProducts.some(el => el.productId === this.product.productId);
                }
            },
            productsList() {
                return this.$store.getters.comparedProducts.length;
            },
            isDisabled() {
                if (!this.isChecked) {
                    return this.productsList >= 2;
                }
                return false
            },
        },
        watch: {
            // unchecking the checkbox if there is no products in state
            productsList(value) {
                if (value === 0 && this.isChecked) {
                    this.isChecked = false;
                }
            },
            isChecked(value) {
                if (value && !this.isCompared) {
                    this.$store.commit('addProductToCompare', this.product);
                } else if (!value) {
                    this.$store.commit('removeProductFromCompare', this.product);
                }
            } 
        },
    }
</script>

<style scoped>
    .cbx-container {
        --cbx-size: 15px;
    }
    .is-disabled {
        opacity: .5;
        cursor: not-allowed;
    }
</style>
