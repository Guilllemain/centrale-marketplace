<template>
    <div class="flex-1 relative">
        <label>Ville</label>
        <select class="w-full block appearance-none bg-white border border-grey-light hover:border-grey px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:border-grey" :name="inputName">
            <option v-if="cityName && cities.length === 0" :value="cityName">{{ cityName }}</option>
            <option v-for="city in cities" :value="city.nom">{{ city.nom }}</option>
        </select>
        <div v-show="cities.length > 1" class="pointer-events-none absolute pin-y pin-r flex items-center px-2 text-grey-darker">
            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
            </svg>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            cityName: {
                required: false,
                type: String
            },
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
