<template>
    <div class="w-1/3 border border-grey-light rounded">
        <form action="/search" method="GET" autocomplete="off">
            <div class="flex items-center justify-content">

                <div class="flex-1">
                    <input class="w-full appearance-none text-grey-darker px-4 leading-tight focus:outline-none focus:bg-white focus:border-grey" type="text" placeholder="Rechercher un produit" name="query" v-model="query" @keyup.esc="query = ''" @keyup="productAutocomplete()">
                    
                    <transition name="fade">
                        <div v-if="productSuggestions.length > 0 && query.length > 3" class="search__results z-50 bg-white rounded-b absolute shadow-md w-29 overflow-hidden">
                            <a :href="productPath(product)" v-for="product in productSuggestions" class="flex items-center hover:bg-grey-lighter pr-2">
                                <div class="w-1/6 flex items-center mr-2">
                                    <img class="w-full" :src="getImage(product)">
                                </div>
                                <div>
                                    <div>{{ limitLength(product.name) }}</div>
                                    <div class="text-xs text-grey-dark">{{ product.price }} €</div>
                                </div>
                            </a>
                        </div>
                    </transition>
                </div>

                <button class="search-button focus:outline-none border-l border-grey-light pt-1 px-2">
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
            limitLength(string) {
                if (string.length > 44) {
                    return string.substring(0, 45) + '...';
                }
                return string;
            },
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
            },
        }
    }
</script>
<style scoped>
    .w-29 {
        width: 29%;    
    }
    .search__results {
        top: 3.3rem;
    }
    .search-icon {
        transition: all .3s;
    }
    .search-button:hover .search-icon {
        transform: scale(1.1);
    }
    .fade-enter-active, .fade-leave-active {
        transition: all .3s;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
        opacity: 0;
    }
</style>
