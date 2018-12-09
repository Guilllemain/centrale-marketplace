<template>
    <div class="container flex">
        <div class="w-1/6">
            <filters-component :categories="categoriesList"></filters-component>
        </div>
        <div class="flex flex-wrap items-start flex-1">
            <product-component v-for="product in products" :product="product" :key="product.productId"></product-component>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import ProductComponent from './ProductComponent';
    import FiltersComponent from './FiltersComponent';

    export default {
        props: {
            category: Number,
            categories: String
        },
        components: {ProductComponent, FiltersComponent},
        data() {
            return {
                categoryId: '',
                products: {},
                categoriesList: ''
            }
        },
        created() {
            this.categoriesList = JSON.parse(this.categories);
            Event.$on('update-results', (categoryId) => {
                this.categoryId = categoryId;
                this.displayResults()
            });
        },
        mounted() {
             if (this.category) this.categoryId = this.category;

            // const urlParams = new URLSearchParams(window.location.search);
            // this.categoryId = urlParams.get('category');
            // console.log(urlParams.get('category'));

            this.displayResults();
        },
        methods: {
            async displayResults() {
                try {
                    const results = await axios.get(`https://sandbox.wizaplace.com/api/v1/catalog/search/products?filters[categories]=${this.categoryId}`)
                    this.products = results.data.results;
                } catch (error) {
                    console.log(error);
                }
            }
        }
    }
</script>
