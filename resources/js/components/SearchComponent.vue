<template>
    <div class="container">
        <div v-if="loading" class="flex items-center justify-center">
            <loader-component size="3rem" :loading="loading"></loader-component>
        </div>
        <div v-else class="flex">
            <div class="w-1/5 pr-8">
                <h2 class="text-grey-darker font-light tracking-wide">Affiner par</h2>
                <a v-if="selectedFacets.length > 0" class="mr-2 mt-2 flex items-end" href="#" @click.prevent="clearFacets">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24">
                        <use class="text-grey fill-current" href="/svg/icons.svg#delete"></use>
                    </svg>
                    <span class="ml-1 text-xs text-grey">Supprimer les filtres</span>
                </a>
                <facets-component v-for="(facet, index) in facets"
                                :facet="facet"
                                :key="index+facet.name"
                                @updatePriceRange="updatePrice">
                </facets-component>
            </div>
            <div class="w-4/5">
                <div class="flex justify-end items-center mb-2">
                    <div class="text-right mx-4">{{ pagination.nbResults }} article(s)</div>
                    <filters-component @addSorting="addSorting"></filters-component>    
                </div>
                <div class="search__products">
                    <product-component v-for="product in products" :product="product" :key="product.productId"></product-component>
                </div>
            </div>
        </div>
        <pagination-component :pagination="pagination" @pageChanged="updatePage"></pagination-component>
    </div>
</template>

<script>
    import axios from 'axios';
    import ProductComponent from './ProductComponent';
    import FiltersComponent from './FiltersComponent';
    import FacetsComponent from './FacetsComponent';
    import PaginationComponent from './PaginationComponent';
    import LoaderComponent from './LoaderComponent';

    export default {
        components: {ProductComponent, FiltersComponent, FacetsComponent, PaginationComponent, LoaderComponent},
        props: {
            category: {
                type: Object,
                required: false
            },
            company: {
                type: Object,
                required: false
            },
        },
        data() {
            return {
                categoryId: '',
                companyId: '',
                query: '',
                products: [],
                facets: [],
                pagination: {},
                page: 1,
                price: '',
                resultsPerPage: 12,
                selectedSorting: '',
                loading: false
            }
        },
        created() {
            Event.$on('update-results', (categoryId) => {
                this.categoryId = categoryId;
                this.displayResults();
            });
        },
        mounted() {
            // delete the facets if the user navigates to another search page
            if (performance.navigation.type !== 1 && performance.navigation.type !== 2) {
                this.$store.commit('clearFacets');
            };

            this.loading = true;
            if(this.category) this.categoryId = this.category.id;
            if(this.company) this.companyId = this.company.id;

            this.displayResults();
        },
        computed: {
            selectedFacets() {
                return this.$store.getters.selectedFacets;
            },
            baseUri() {
                const url = [];
                const urlParams = new URLSearchParams(window.location.search);
                this.query = urlParams.get('query') === null ? '' : urlParams.get('query');
                
                url.push(`/api/search/products?query=${this.query}&page=${this.page}&resultsPerPage=${this.resultsPerPage}`);

                if(this.categoryId) url.push(`&filters[categories]=${this.categoryId}`);
                if(this.companyId) url.push(`&filters[companies]=${this.companyId}`);
                if(this.selectedSorting) url.push(this.selectedSorting);

                if(this.selectedFacets.length > 0) {
                    this.selectedFacets.forEach(facet => url.push(`&filters[${facet.name}][]=${facet.value}`))
                }

                if(this.price) url.push(`&filters[price][min]=${this.price.min}&filters[price][max]=${this.price.max}`)

                return url.join('');
            }
        },
        watch: {
            selectedFacets() {
                this.displayResults();
            }
        },
        methods: {
            updatePrice(event) {
                this.price = event;
                this.displayResults();
            },
            updatePage(event) {
                this.page = event;
                this.displayResults();
            },
            addSorting(event) {
                this.selectedSorting = event;
                this.displayResults();
            },
            async displayResults() {
                try {
                    const results = await axios.get(this.baseUri);
                    this.products = results.data.results;
                    this.filterFacets(results.data.facets);
                    this.pagination = results.data.pagination;
                    this.loading = false;
                } catch (error) {
                    console.log(error);
                }
            },
            clearFacets() {
                this.$store.commit('clearFacets');
            },
            filterFacets(facets) {
                Object.keys(facets).map(function (facetId) {
                    if (typeof facets[facetId].values != 'undefined') {
                        Object.keys(facets[facetId].values).map(function (variantId) {
                            // remove ∅ variant
                            if (facets[facetId].values[variantId].label === '∅') {
                                delete facets[facetId].values[variantId];
                            }
                        });
                    }
                });
                this.facets = facets.filter(facet => {
                    if (facet.name != 3 && facet.name != 4 && facet.name != 5 && facet.name != 24) return !this.isEmpty(facet.values);
                })
            },
            isEmpty(obj) {
                for(var key in obj) {
                    if(obj.hasOwnProperty(key))
                        return false;
                }
                return true;
            }
        }
    }
</script>

<style scoped>
    .search__products {
        display: grid;
        align-content: start;
        justify-content: start;
        grid-template-columns: repeat(4, 1fr);
    }
</style>
