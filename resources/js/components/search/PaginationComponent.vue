<template>
    <div class="my-6 mx-4 flex justify-end">
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
            }
        },
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
        }
    }
</script>
