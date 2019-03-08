<template>
    <transition name="fade" @after-enter="viewContent = true">
        <div class="modal flex items-center justify-center" @click="closeModal">
            <span class="close__icon cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8">
                    <use class="text-white fill-current" href="/svg/icons.svg#close"></use>
                </svg>
            </span>
            <transition name="scale">
                <div class="modal-content" @click.stop v-show="viewContent">
                    <slot></slot>
                </div>
            </transition>
        </div>
    </transition>
</template>

<script>
export default {
    data() {
        return {
            viewContent: false
        }
    },
    mounted() {
        document.body.classList.add('overflow-hidden'); // prevent scrolling in the background
    },
    methods: {
        openModal() {
            this.viewModal = true;
        },
        closeModal() {
            this.viewContent = false;
            this.$emit('closeModal');
        },
    },
    beforeDestroy() {
        document.body.classList.remove('overflow-hidden');
    }
}
</script>

<style scoped>
    .modal {
        position: fixed;
        z-index: 10;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, .85);
        transition: all .4s ease-in-out;
    }
    .modal-content {
        width: 88vh;
    }
    .fade-enter-active, .fade-leave-active {
        transition: opacity .2s;
    }
    .fade-enter, .fade-leave-to {
        opacity: 0;
    }
    .scale-enter-active {
        animation: scaleIn .2s ease-in-out forwards;
    }
    .scale-leave-active {
        animation: scaleOut .2s ease-in-out forwards;
    }
    @keyframes scaleIn {
        0% {opacity: 0; transform: scale(.75);}
        100% {opacity: 1;transform: scale(1);}
    }
    @keyframes scaleOut {
        0% {opacity: 1;transform: scale(1);}
        100% {opacity: 0; transform: scale(.75);}
    }
</style>

