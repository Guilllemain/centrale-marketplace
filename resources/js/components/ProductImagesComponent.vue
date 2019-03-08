<template>
    <div class="product__images">
        <div class="flex">
            <!-- thumbnails -->
            <div class="mr-2 thumbnail__list">
                <div
                    class="flex items-center thumbnail__image cursor-pointer border border-grey-light mb-1"
                    v-for="(image, index) in images"
                    :key="image.id"
                    @click="currentSlide(index)"
                    @mouseover="currentSlide(index)"
                    :class="{'thumbnail--active': slideIndex === index }"
                >
                    <img class="w-full" :src="getImage(image.id, 100)" :alt="`${name}-${index}`">
                </div>
            </div>
            <!-- main image -->
            <div class="flex image__main flex-col">
                <img
                    class="w-full"
                    v-for="(image, index) in images"
                    :key="image.id"
                    v-show="index === slideIndex"
                    :src="getImage(image.id, 490)"
                    @click="isOpenModal = true"
                >
            </div>
        </div>

        <!-- modal -->
        <modal-component @closeModal="isOpenModal = false" v-if="isOpenModal">
            <div class="flex items-center justify-center">
                <a class="prev" @click="plusSlides(-1)">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8">
                        <use class="text-white fill-current" href="/svg/icons.svg#navigate-prev"></use>
                    </svg>
                </a>
                <img
                    v-for="(image, index) in images"
                    :key="image.id"
                    v-show="index === slideIndex"
                    :src="getImage(image.id, 1000)"
                    class="w-full px-4"
                >
                <a class="next" @click="plusSlides(1)">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8">
                        <use class="text-white fill-current" href="/svg/icons.svg#navigate-next"></use>
                    </svg>
                </a>
            </div>
        </modal-component>
    </div>
</template>

<script>
import ModalComponent from "./ModalComponent";

export default {
    components: { ModalComponent },
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
            isOpenModal: false
        };
    },
    methods: {
        getImage(id, size) {
            return `${
                process.env.MIX_MARKETPLACE_BASE_URI
            }image/${id}?w=${size}&h=${size}`;
        },
        currentSlide(index) {
            this.slideIndex = index;
        },
        showSlides() {
            if (this.slideIndex >= this.images.length) {
                this.slideIndex = 0;
            }
            if (this.slideIndex < 0) {
                this.slideIndex = this.images.length - 1;
            }
        },
        plusSlides(number) {
            this.slideIndex += number;
            this.showSlides();
        }
    }
};
</script>

<style scoped>
    .thumbnail__list {
        flex-basis: 8%;
    }
    .product__images {
        flex: 0 0 50%;
    }
    .image__main {
        cursor: zoom-in;
    }
    .thumbnail__image {
        opacity: 0.7;
        transition: all 0.3s ease-in-out;
    }
    .thumbnail__image:hover {
        opacity: 1;
        transform: scale(1.07);
    }

    /* Next & previous buttons */
    .prev,
    .next {
        cursor: pointer;
        opacity: 0.8;
        transition: all 0.4s ease-in-out;
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
</style>
