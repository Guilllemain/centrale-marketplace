<template>
    <div class="mt-2 mb-4">
        <el-rate
          v-model="value"
          :disabled="disabled"
          text-color="#ff9900"
          @change="rateProduct"
        >
        </el-rate>
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
            }
        }
    }
</script>
