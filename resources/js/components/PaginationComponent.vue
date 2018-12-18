<template>
    <div class="my-6 mx-4 flex justify-end">
    <!-- <ul class="my-6 mx-4 list-reset flex justify-center">
        <li><button @click="onClickFirstPage" type="button">First</button></li>
        <li><button @click="onClickPreviousPage" type="button">Previous</button></li>

        <li v-for="page in pages" :key="page.name" :class="{ active: isPageActive(page.name) }">
              <button @click="onClickPage(page.name)" type="button" :disabled="page.isDisabled">{{ page.name }}</button>
        </li>

        <li><button @click="onClickNextPage" type="button">Next</button></li>
        <li><button @click="onClickLastPage" type="button">Last</button></li>
    </ul> -->
        <el-pagination
          background
          layout="prev, pager, next"
          @current-change="onClickPage"
          @prev-click="onClickPreviousPage"
          @next-click="onClickNextPage"
          :page-count="pagination.nbPages"
          :page-size="pagination.resultsPerPage"
          :current-page="pagination.page"
          :total="pagination.nbResults">
        </el-pagination>
    </div>
</template>

<script>
    export default {
        props: {
            pagination: {
                type: Object,
                required: true
            },
        },

        data() {
            return {
                // maxVisibleButtons: 3
            }
        },
        // computed: {
        //     startPage() {
        //         // When on the first page
        //         if (this.pagination.page === 1) {
        //             return 1;
        //         }
        //         // When on the last page
        //         if (this.pagination.page === this.pagination.nbPages) {
        //             return this.pagination.nbPages - this.maxVisibleButtons;
        //         }
        //         // When in between
        //         return this.pagination.page - 1;
        //     },
        //     pages() {
        //         const range = [];

        //         for (let i = this.startPage;
        //             i <= Math.min(this.startPage + this.maxVisibleButtons - 1, this.pagination.nbPages);
        //             i+= 1 ) {
        //             range.push({
        //                 name: i,
        //                 isDisabled: i === this.pagination.page
        //             });
        //         }

        //         return range;
        //     },
        //     isInFirstPage() {
        //         return this.pagination.page === 1;
        //     },
        //     isInLastPage() {
        //         return this.pagination.page === this.pagination.nbPages;
        //     },
        // },
        methods: {
            onClickPage(event) {
                this.$emit('pageChanged', event);
            },
            onClickNextPage(event) {
                this.$emit('pageChanged', event);
            },
            onClickPreviousPage(event) {
                this.$emit('pageChanged', event);
            },
            onClickFirstPage() {
                this.$emit('pageChanged', 1);
            },
            // onClickPreviousPage() {
            //     this.$emit('pageChanged', this.pagination.page - 1);
            // },
            // onClickPage(page) {
            //     this.$emit('pageChanged', page);
            // },
            // onClickNextPage() {
            //     this.$emit('pageChanged', this.pagination.page + 1);
            // },
            // onClickLastPage() {
            //     this.$emit('pageChanged', this.pagination.nbPages);
            // },
            // isPageActive(page) {
            //     return this.pagination.page === page;
            // }
        }
    }
</script>
<style scoped>
    /*.active {
        background-color: #4AAE9B;
        color: white;
    }

    ul li{
        margin-right: 0.2rem;
        padding: 0.5rem;
        border: 1px solid #777;
    }*/
</style>