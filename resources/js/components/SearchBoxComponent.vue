<template>
    <form action="/search" method="GET" autocomplete="off" class="relative w-1/3 flex items-center justify-center">
        <input  class="search__input border border-grey-light rounded appearance-none text-grey-darker py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-grey"
                type="text"
                placeholder="Rechercher un produit"
                name="query"
                v-model="query"
                @keyup.esc="query = ''"
                @focus="showResults = true"
                @blur="showResults = false">
        
        <transition name="fade">
            <div v-show="showResults && query.length > 3">
                <div class="search__results w-89 z-50 bg-white rounded-b absolute shadow-md w-full overflow-hidden">
                    <div v-if="loading" class="m-4">
                        <div class="flex justify-center">
                            <loader-component></loader-component>
                        </div>
                    </div>
                    <div v-else-if="productSuggestions.length > 0">
                        <a :href="productPath(product)" v-for="product in productSuggestions" :key="product.productId" class="flex items-center hover:bg-grey-lighter pr-2">
                            <div class="w-1/6 flex items-center mr-2 search__image">
                                <img class="w-full" :src="getImage(product)">
                            </div>
                            <div>
                                <div>{{ limitLength(product.name) }}</div>
                                <div class="text-xs text-grey-dark">{{ product.price }} €</div>
                            </div>
                        </a>
                    </div>
                    <div v-else class="m-4 text-grey-dark">
                        Votre recherche ne donne aucun résultat
                    </div>
                </div>
            </div>
        </transition>
        
        <button class="search__button focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 search__icon">
                <use class="text-orange-dark fill-current" href="/svg/icons.svg#search"></use>
            </svg>
        </button>
    </form>
</template>

<script>
    import axios from 'axios';
    import _ from 'lodash';
    import LoaderComponent from './LoaderComponent';

    export default {
        components: {LoaderComponent},
        data() {
            return {
                query: '',
                productSuggestions: [],
                loading: false,
                showResults: false
            }
        },
        watch: {
            query() {
                this.loading = true;
                this.productAutocomplete();
            }
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
                    return `${process.env.MIX_MARKETPLACE_BASE_URI}image/${product.mainImage['id']}?w=120&h=120`;
                }
                return 'https://upload.wikimedia.org/wikipedia/commons/a/ac/No_image_available.svg';
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
                const results = await axios.get('/searchbox', {
                    params: {
                        query: this.query
                    }
                });
                this.loading = false;

                // fill suggestions
                this.productSuggestions = results.data;
            },
        }
    }
</script>
<style scoped>
    .search__image {
        background-image: url('/spinner.gif');
        background-size: cover;
        height: 57.98px;
    }
    .w-89 {
        width: 89%;    
    }
    .search__results {
        top: 2.45rem;
        left: .4rem;
    }
    .search__icon {
        transition: all .2s ease-in-out;
    }
    .search__button:hover .search__icon {
        transform: scale(1.1);
    }
    .fade-enter-active, .fade-leave-active {
        transition: all .3s ease-in-out;
    }
    .fade-enter, .fade-leave-to {
        opacity: 0;
    }
    .search__input {
        width: 95%;
        transition: all .3s;
        margin-right: -2.5rem;
    }
    .search__input:focus {
        width: 100%;
    }
</style>
