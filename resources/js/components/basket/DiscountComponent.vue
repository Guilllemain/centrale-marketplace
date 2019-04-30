<template>
    <div class="my-4">
        <a @click="showInput = !showInput" class="cursor-pointer block mb-2 text-orange-dark hover:text-orange">Vous avez un code promo ?</a>
        <div v-if="showInput" class="flex">
            <input class="appearance-none border rounded-l border-r-0 w-full py-3 px-3 text-grey-darker leading-tight focus:outline-none focus:border-grey" type="text" name="coupon" placeholder="Code promo">
            <button class="w-1/3 btn btn-grey text-xs rounded-r rounded-l-none">Ajouter</button>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            showInput: false
        }
    }
}
</script>

