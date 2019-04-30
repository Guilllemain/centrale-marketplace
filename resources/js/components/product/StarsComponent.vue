<template>
    <div class="mt-2 mb-4 flex">
        <el-rate
          v-model="value"
          :disabled="disabled"
          text-color="#ff9900"
          @change="rateProduct"
        >
        </el-rate>
        <a @click="showReview" href="#avis" id="show-review" class="text-grey-dark ml-3">9 avis</a>
    </div>
</template>

<script>
    export default {
        props: {
            disabled: {
                required: false,
                type: Boolean,
                default: true
            }
        },
        data() {
            return {
                value: 4
            }
        },
        methods: {
            rateProduct() {
                this.$emit('rate', this.value);
            },
            showReview() {
                document.querySelector('#tab3').checked = true;
            }
        }
    }
</script>
