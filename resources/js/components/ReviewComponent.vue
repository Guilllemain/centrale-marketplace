<template>
    <form @submit.prevent="publishReview" class="flex flex-col w-1/3">
        <stars-component :disabled="false" @rate="rating"></stars-component>
        <textarea class="bg-grey-lightest appearance-none border border-grey-lighter rounded py-2 px-4 text-grey-darker leading-tight focus:outline-none focus:bg-white focus:border-grey" rows="5" placeholder="Ajouter un commentaire"></textarea>
        <button type="submit" class="btn my-4 btn-grey">Publier</button>
    </form>
</template>

<script>
    export default {
        data() {
            return {
                value: ''
            }
        },
        methods: {
            rating(event) {
                this.value = event;
            },
            publishReview() {
                console.log(this.value);
            }
        }
    }
</script>
