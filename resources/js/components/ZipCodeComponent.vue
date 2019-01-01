<template>
    <div class="w-1/5 mr-8">
        <label>Code postal</label>
        <div class="pb-4">
            <input v-model="zipcode" @keyup="getZipCode" type="number" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" :name="inputName" placeholder="Votre code postal" required>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        props: {
            inputName: {
                required: true,
                type: String
            }
        },
        data() {
            return {
                zipcode: ''
            }
        },
        methods: {
            async getZipCode() {
                if (this.zipcode.length > 4) {
                    const response = await axios.get(`https://geo.api.gouv.fr/communes?codePostal=${this.zipcode}`);
                    // console.log(response.data[0].nom);
                    this.$emit('updateCityName', response.data[0].nom);
                }
            }
        }
    }
</script>
