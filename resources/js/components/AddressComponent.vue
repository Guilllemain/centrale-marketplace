<template>
    <div class="flex">
        <zipcode-component :old-zipcode="zipcode" @updateCityName="updateCity" :inputName="zipCodeInputName"></zipcode-component>
        <city-component :city-name="cityName" :cities="cities" :inputName="cityInputName"></city-component>
    </div>
</template>

<script>
    import ZipcodeComponent from './ZipCodeComponent';
    import CityComponent from './CityComponent';

    export default {
        components: {ZipcodeComponent, CityComponent},
        props: {
            zipcode: {
                required: false,
                type: String
            },
            cityName: {
                required: false,
                type: String
            },
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
