<template>
    <div class="flex-1">
        <label>Ville</label>
        <select class="w-full block appearance-none bg-white border border-grey-light hover:border-grey px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline" :name="inputName">
            <option v-for="city in cities" :value="city.nom">{{ city.nom }}</option>
        </select>
    </div>
</template>

<script>
    export default {
        props: {
            cities: {
                required: true,
                type: Array
            },
            inputName: {
                required: true,
                type: String
            }
        },
        data() {
            return {
            }
        },
    }
</script>
