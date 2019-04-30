<template>
    <el-select v-model="sortingValue" @change="addSorting" placeholder="Trier par..." class="mx-3">
        <el-option value="&sorting[price]=asc" label="Prix croissant">Prix croissant</el-option>
        <el-option value="&sorting[price]=desc" label="Prix décroissant">Prix décroissant</el-option>
        <el-option value="&sorting[createdAt]=asc" label="Les plus récents">Les plus récents</el-option>
        <el-option value="&sorting[createdAt]=desc" label="Les plus anciens">Les plus anciens</el-option>
    </el-select>
</template>

<script>
    export default {
        props: {
        },
        data() {
            return {
                sortingValue: ''
            }
        },
        methods: {
            addSorting() {
                this.$emit('addSorting', this.sortingValue);
            }
        }
    }
</script>
