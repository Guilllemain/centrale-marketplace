<template>
    <div>
        <div class="flex">
            <div class="pr-4">
                <div class="flex items-center thumbnail__image cursor-pointer border border-grey-light mb-2"
                     v-for="(image, index) in images" :key="image.id" 
                     @click="currentSlide(index)"
                     @mouseover="currentSlide(index)"
                     :class="{'thumbnail--active': slideIndex === index }">
                    <img class="w-full" :src="getImage(image.id, 100)" :alt="`${name}-${index}`">
                </div>
            </div>
            <div class="flex flex-col">
                <img class="w-full cursor-pointer"
                     v-for="(image, index) in images" :key="image.id"
                     v-if="index === slideIndex"
                     :src="getImage(image.id, 420)"
                     @click="openModal">
            </div>
        </div>
        <transition name="fade" @after-enter="viewContent = true">
            <div class="modal flex items-center justify-center" @click="closeModal" v-if="viewModal">
                <span class="close cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8">
                        <use class="text-white fill-current" href="/svg/icons.svg#close"></use>
                    </svg>
                </span>
                
                <transition name="scale">
                    <div class="modal-content flex items-center justify-center" @click.stop v-show="viewContent">
                        <a class="prev" @click="plusSlides(-1)">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8">
                                <use class="text-white fill-current" href="/svg/icons.svg#navigate-prev"></use>
                            </svg>
                        </a>
                        <img v-for="(image, index) in images" :key="image.id"
                             v-if="index === slideIndex"
                             :src="getImage(image.id, 1000)"
                             class="w-full px-4">
                        <a class="next" @click="plusSlides(1)">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8">
                                <use class="text-white fill-current" href="/svg/icons.svg#navigate-next"></use>
                            </svg>
                        </a>
                    </div>
                </transition>
                
            </div>
        </transition>
    </div>
</template>

<script>
    export default {
        props: {
            images: {
                type: Array,
                required: true
            },
            name: {
                type: String,
                required: true
            }
        },
        data() {
            return {
                slideIndex: 0,
                viewModal: false,
                viewContent: false
            }
        },
        methods: {
            getImage(id, size) {
                return `${process.env.MIX_MARKETPLACE_BASE_URI}image/${id}?w=${size}&h=${size}`;
            },
            currentSlide(index) {
                this.slideIndex = index;
            },
            showSlides() {
                if (this.slideIndex >= this.images.length) {this.slideIndex = 0}
                if (this.slideIndex < 0) {this.slideIndex = this.images.length - 1}
            },
            openModal() {
                this.viewModal = true;
            },
            closeModal() {
                this.viewContent = false;
                this.viewModal = false;
            },
            plusSlides(number) {
                this.slideIndex += number;
                this.showSlides();
            }
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
        transition: all .5s;
    }
    .modal-content {
        width: 88vh;
    }
    .thumbnail__image {
        opacity: .70;
        transition: all .3s;
    }
    .thumbnail__image:hover {
        opacity: 1;
        transform: scale(1.07);
    }
    .close {
        position: absolute;
        top: 1rem;
        right: 1.5rem;
        opacity: .8;
        cursor: pointer;
    }

    .close:hover,
    .close:focus {
        opacity: 1;
    }

    .close:hover {
        transform: scale(1.1);
    }
    
    /* Next & previous buttons */
    .prev,
    .next {
      cursor: pointer;
      opacity: .8;
      transition: all 0.6s ease;
    }

    .prev:hover,
    .next:hover {
        opacity: 1;
        transform: scale(1.1);
    }
    .thumbnail--active {
      border: solid 1px #bbb;
      opacity: 1;
    }
    .fade-enter-active, .fade-leave-active {
        transition: opacity .2s;
    }
    .fade-enter, .fade-leave-to {
        opacity: 0;
    }
    .scale-enter-active {
        animation: scaleIn .2s ease-out forwards;
    }
    .scale-leave-active {
        animation: scaleOut .2s ease-out forwards;
    }
    .scale-enter, .scale-leave-to {
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
