<template>
    <div>
        <input @click="newCategory()" type="radio" :id="category.category.id" :checked="isChecked()" name="radio-btn">
        <label class="pl-1" :for="category.category.id">{{ category.category.name }}</label>
        <div :id="category.category.slug" class="hidden">
            <slot></slot>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            category: Object
        },
        data() {
            return {
            }
        },
        methods: {
            newCategory() {
                history.pushState(null, '', `/search?category=${this.category.category.id}`);
                this.toggleHidden();
                Event.$emit('update-results', this.category.category.id);
            },
            isChecked() {
                const urlParams = new URLSearchParams(window.location.search);
                return this.category.category.id === Number(urlParams.get('category'))
            },
            toggleHidden() {
                document.querySelector(`#${this.category.category.slug}`).classList.toggle('hidden');
            }
        },
        mounted() {
            if (this.isChecked()) this.toggleHidden();
        }
    }
</script>
