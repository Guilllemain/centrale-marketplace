<template>
    <div class="mt-2 mb-4">
        <el-rate
          v-model="value4"
          disabled
          text-color="#ff9900"
        >
        </el-rate>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                value4: 4
            }
        },
        methods: {
        }
    }
</script>
