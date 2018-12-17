<template>
    <div class="container">
        <div class="flex">
            <div class="w-1/6">
                <filters-component v-show="products"></filters-component>
                <facets-component v-for="(facet, index) in facets" :facet="facet" :key="index" @addFacet="testing()" :facetIndex="index"></facets-component>
            </div>
            <div class="flex flex-wrap items-start flex-1">
                <product-component v-for="product in products" :product="product" :key="product.productId"></product-component>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import ProductComponent from './ProductComponent';
    import FiltersComponent from './FiltersComponent';
    import FacetsComponent from './FacetsComponent';

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
        components: {ProductComponent, FiltersComponent, FacetsComponent},
        data() {
            return {
                categoryId: '',
                companyId: '',
                query: '',
                products: [],
                facets: [],
                pagination: [],
                selectedFacets: {}
            }
        },
        created() {
            Event.$on('update-results', (categoryId) => {
                this.categoryId = categoryId;
                this.displayResults();
            });
        },
        mounted() {
            const urlParams = new URLSearchParams(window.location.search);
            this.query = urlParams.get('query') === null ? '' : urlParams.get('query');

            if(this.category) this.categoryId = this.category.id;
            if(this.company) this.companyId = this.company.id;

            this.displayResults();

            // this.categoryId = urlParams.get('category');
            // console.log(urlParams.get('category'));
            // if (this.category) thicategoryId = this.category;

        },
        methods: {
            testing(event) {
                console.log(event)
            },
            async displayResults() {
                try {
                    const results = await axios.get(`/api/search/products?query=${this.query}&filters[categories]=${this.categoryId}&filters[companies]=${this.companyId}`);
                    console.log(results.data);
                    this.products = results.data.results;
                    this.facets = results.data.facets;
                    this.pagination = results.data.pagination;
                } catch (error) {
                    console.log(error);
                }
            },
        }
    }
</script>
