<template>
    <div>
        <h3>Categories</h3>
        <!-- <category-filters-component 
            v-for="category in categories"
            :key="category.category.id"
            :category="category">
            <category-filters-component
                class="ml-4"
                v-if="category.children"
                v-for="category in category.children"
                :key="category.category.id"
                :category="category">
                <category-filters-component
                    class="ml-4"
                    v-if="category.children"
                    v-for="category in category.children"
                    :key="category.category.id"
                    :category="category">
                </category-filters-component>
            </category-filters-component>
        </category-filters-component> -->
    </div>
</template>

<script>
    import CategoryFiltersComponent from './CategoryFiltersComponent';

    export default {
        props: {
            categories: Array
        },
        components: {CategoryFiltersComponent},
        data() {
            return {
            }
        },
        methods: {
        }
    }
</script>
