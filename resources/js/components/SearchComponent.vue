<template>
    <div class="container">
        <div class="flex">
            <div class="w-1/6">
                <filters-component v-show="products"></filters-component>
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
            // categories: {
            //     type: Array,
            //     required: true
            // },
        },
        components: {ProductComponent, FiltersComponent},
        data() {
            return {
                categoryId: '',
                companyId: '',
                query: '',
                products: [],
            }
        },
        created() {
            Event.$on('update-results', (categoryId) => {
                this.categoryId = categoryId;
                this.displayResults();
            });
        },
        mounted() {
            // const slug = window.location.pathname.replace('/', '');
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
            // async getCategoryId(slug) {
            //     try {
            //         const results = await axios.get(`/${slug}?slug=${slug}`);
            //         this.category = results.data;
            //         this.categoryId = results.data.id;
            //         this.displayResults();
            //     }
            //     catch (error) {
            //         console.log(error);
            //     }
            // },
            async displayResults() {
                try {
                    const results = await axios.get(`/api/search/products?query=${this.query}&filters[categories]=${this.categoryId}&filters[companies]=${this.companyId}`);
                    console.log(results);
                    this.products = results.data;
                } catch (error) {
                    console.log(error);
                }
            },
        }
    }
</script>
