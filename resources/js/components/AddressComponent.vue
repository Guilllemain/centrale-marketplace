<template>
    <div class="flex">
        <zipcode-component @updateCityName="updateCity" :inputName="zipCodeInputName"></zipcode-component>
        <city-component :cities="cities" :inputName="cityInputName"></city-component>
    </div>
</template>

<script>
    import ZipcodeComponent from './ZipCodeComponent';
    import CityComponent from './CityComponent';

    export default {
        components: {ZipcodeComponent, CityComponent},
        props: {
            zipCodeInputName: {
                required: true,
                type: String
            },
            cityInputName: {
                required: true,
                type: String
            }
        },
        data() {
            return {
                cities: []
            }
        },
        methods: {
            updateCity(event) {
                this.cities = event;
            }
        }
    }
</script>
