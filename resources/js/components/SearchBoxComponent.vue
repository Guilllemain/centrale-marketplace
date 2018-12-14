<template>
    <form action="/search" class="" method="GET" autocomplete="off">

        <div class="flex items-center justify-content border border-grey-light rounded">

            <div class="flex flex-col w-64">
                <input class="w-128 appearance-none block text-grey-darker py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-grey" type="text" placeholder="Rechercher un produit" name="query" v-model="query" @keyup.esc="query = ''" @keyup="productAutocomplete()">

                <div v-if="productSuggestions.length > 0 && query.length > 3" class="z-50">
                    <ul class="list-reset absolute bg-white border border-grey-lighter">
                        <li v-for="product in productSuggestions">
                            <a :href="`/product/${product.productId}`">{{ product.name }}</a>
                        </li>
                    </ul>
                </div>
            </div>

            <button class="focus:outline-none border-l border-grey-light pt-1 px-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24">
                    <path class="text-orange-dark fill-current" d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                    <path d="M0 0h24v24H0z" fill="none"/>
                </svg>
            </button>
        </div>
        

    </form>
</template>

<script>
    import axios from 'axios';
    import _ from 'lodash';

    export default {
        data() {
            return {
                query: '',
                productSuggestions: []
            }
        },
        mounted() {

        },
        methods: {
            productAutocomplete: _.debounce(function () {
                    this.getResults();
                },
                // how long to wait for user to stop typing (in ms)
                300
            ),
            async getResults() {
                const results = await axios.get('https://back.vegan-place.com/api/v1/catalog/search/products/autocomplete', {
                    params: {
                        query: this.query
                    }
                });

                // don't display suggestions if there is only one and that already matches user input
                if (results.data.length === 1 && results.data[0].name === this.query) {
                    this.productSuggestions = [];
                    return;
                }

                // fill suggestions
                this.productSuggestions = results.data;
                console.log(results.data);
            },
        }
    }
</script>
