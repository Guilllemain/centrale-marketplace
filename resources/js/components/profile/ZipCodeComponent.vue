<template>
    <div class="w-1/5 mr-8">
        <label>Code postal</label>
        <div class="pb-4">
            <input v-model="zipcode" @keyup="getZipCode" type="number" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:border-grey" :name="inputName" placeholder="Votre code postal" required>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            oldZipcode: {
                required: false,
                type: String
            },
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
        mounted() {
            if(this.oldZipcode) {
                this.zipcode = this.oldZipcode;
            }
        },
        methods: {
            async getZipCode() {
                if (this.zipcode.length > 4) {
                    const response = await axios.get(`https://geo.api.gouv.fr/communes?codePostal=${this.zipcode}`);
                    this.$emit('updateCityName', response.data);
                }
            }
        }
    }
</script>
