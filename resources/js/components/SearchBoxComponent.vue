<template>
    <div class="border border-grey-light rounded">
    <form action="/search" class="" method="GET" autocomplete="off">

        <div class="flex items-center justify-content">

            <div class="w-64">
                <input class="appearance-none text-grey-darker px-4 leading-tight focus:outline-none focus:bg-white focus:border-grey" type="text" placeholder="Rechercher un produit" name="query" v-model="query" @keyup.esc="query = ''" @keyup="productAutocomplete()">
                
                <div v-if="productSuggestions.length > 0 && query.length > 3" class="pt-2 search__results z-50 bg-white rounded-b absolute shadow-md w-64">
                   <!--  <ul class="list-reset absolute bg-white border border-grey-lighter">
                        <li v-for="product in productSuggestions">
                            <a :href="`/product/${product.productId}`">{{ product.name }}</a>
                        </li>
                    </ul> -->
                    <div class="" v-for="product in productSuggestions" class="flex items-center hover:bg-grey-lighter">
                        <div class="w-1/6 flex items-center mr-2">
                            <img class="w-full" :src="getImage(product)">
                        </div>
                        <a class="w-5/6 mr-2" :href="productPath(product)">{{ product.name }}</a>
                    </div>
                </div>
            </div>

            <button class="focus:outline-none border-l border-grey-light pt-1 px-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 search-icon">
                    <use class="text-orange-dark fill-current" href="/svg/icons.svg#search"></use>
                </svg>
            </button>
        </div>
        

    </form>
</div>
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
            getImage(product) {
                if (product) {
                    return `https://back.vegan-place.com/api/v1/image/${product.mainImage['id']}?w=256&h=256`
                }
                return 'https://upload.wikimedia.org/wikipedia/commons/a/ac/No_image_available.svg'
            },
            productPath(product) {
                if(product.categoryPath.length > 2) {
                    return `/${product.categoryPath[0]['slug']}/${product.categoryPath[1]['slug']}/${product.categoryPath[2]['slug']}/${product.slug}`;
                } else {
                    return `/${product.categoryPath[0]['slug']}/${product.categoryPath[1]['slug']}/${product.slug}`;
                }
            },
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
<style>
    .search__results {
        top: 3.3rem;
    }
    .search-icon {
        transition: all .3s;
    }
    .search-icon:hover {
        transform: scale(1.1);
    }
</style>
