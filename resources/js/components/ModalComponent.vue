<template>
    <modal name="comparison" :adaptive="true" width="100%" height="200" :pivotY="1.0">
        <div slot="top-right">
          <button @click="$modal.hide('comparison')">
            ❌
          </button>
        </div>
        <div class="flex justify-around">
            <!-- <h3 v-for="product in products">{{ product.name }}</h3> -->
            <div>HEY</div>
            <div>HEY</div>
            <div>HEY</div>
        </div>
    </modal>
</template>

<script>
    export default {
        data() {
            return {
            }
        },
        methods: {
        }
    }
</script>
