<template>
    <div class="container">
        <div v-if="loading" class="flex items-center justify-center">
            <loader-component size="3rem" :loading="loading"></loader-component>
        </div>
        <div v-else class="flex">
            <div class="w-1/5 pr-8">
                <h2 class="text-grey-darker">Affiner par</h2>
                <facets-component v-for="(facet, index) in facets"
                                :facet="facet"
                                :key="index"
                                @addFacet="addFacet"
                                @deleteFacet="deleteFacet"
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
        components: {ProductComponent, FiltersComponent, FacetsComponent, PaginationComponent, LoaderComponent},
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
                selectedFacets: [],
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
            this.loading = true;
            const urlParams = new URLSearchParams(window.location.search);
            this.query = urlParams.get('query') === null ? '' : urlParams.get('query');

            if(this.category) this.categoryId = this.category.id;
            if(this.company) this.companyId = this.company.id;

            this.displayResults();
        },
        computed: {
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
        methods: {
            updatePrice(event) {
                this.price = event;
                this.displayResults();
            },
            updatePage(event) {
                this.page = event;
                this.displayResults();
            },
            addFacet(event) {
                this.selectedFacets.push(event);
                this.displayResults();
            },
            deleteFacet(event) {
                this.selectedFacets.splice(event);
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
                this.facets = facets.filter(facet => !this.isEmpty(facet.values));
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
