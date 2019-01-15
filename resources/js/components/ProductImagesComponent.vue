<template>
    <div>
        <div class="flex">
            <div class="pr-4">
                <div v-for="(image, index) in images" :key="index" ref="thumbnails" class="flex items-center thumbnail__image hover:cursor-pointer border border-grey-light mb-2"
                    @click="currentSlide(index+1)">
                    <img class="w-full" :src="getImage(image.id, 100)" :alt="`${name}-${index}`">
                </div>
            </div>
            <div class="flex flex-col">
                <img v-for="(image, index) in images" :key="index" ref="slides" class="hidden w-full hover:cursor-pointer"
                    :src="getImage(image.id, 420)"
                    @click="openModal">
            </div>
        </div>
        <div class="modal" ref="modal" @click="closeModal">
            <span class="close cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" ref="close" class="h-8 w-8">
                    <use class="text-white fill-current" href="/svg/icons.svg#close"></use>
                </svg>
            </span>
            <div class="modal-content">
                <img ref="modalImages" v-for="(image, index) in images" class="hidden w-full" :src="getImage(image.id, 1000)">
                <a class="prev" @click="plusSlides(-1)">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8">
                        <use class="text-white fill-current" href="/svg/icons.svg#navigate-prev"></use>
                    </svg>
                </a>
                <a class="next" @click="plusSlides(1)">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8">
                        <use class="text-white fill-current" href="/svg/icons.svg#navigate-next"></use>
                    </svg>
                </a>
            </div>
        </div>
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
            },
        },
        data() {
            return {
                slideIndex: 1
            }
        },
        mounted() {
            this.showSlides();
        },
        methods: {
            getImage(id, size) {
                return `https://back.vegan-place.com/api/v1/image/${id}?w=${size}&h=${size}`
            },
            currentSlide(number) {
                this.slideIndex = number;
                this.showSlides();
            },
            showSlides() {
                if (this.slideIndex > this.images.length) {this.slideIndex = 1}
                if (this.slideIndex < 1) {this.slideIndex = this.images.length}
                for (let i = 0; i < this.images.length; i++) {
                    this.$refs.slides[i].classList.add('hidden');
                }
                this.$refs.thumbnails.forEach(thumbnail => thumbnail.classList.remove('thumbnail--active'));
                this.$refs.thumbnails[this.slideIndex-1].classList.add('thumbnail--active');
                this.$refs.slides[this.slideIndex-1].classList.toggle('hidden');
            },
            openModal() {
                this.$refs.modal.classList.add('modal--active');
                this.showModalImage();
            },
            showModalImage() {
                this.$refs.modalImages.forEach(image => image.classList.add('hidden'));
                this.$refs.modalImages[this.slideIndex-1].classList.toggle('hidden');
            },
            closeModal(event) {
                if(event.target.tagName !== 'DIV' && event.target !== this.$refs.close) return;
                this.$refs.modal.classList.remove('modal--active');
            },
            plusSlides(number) {
                this.slideIndex += number;
                this.showSlides();
                this.showModalImage();
            }
        }
    }
</script>
<style scoped>
    .modal {
      visibility: hidden;
      display: none;
      position: fixed;
      opacity: 0;
      z-index: 10;
      padding-top: 50px;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0, 0, 0, .8);
      transition: all .5s;
    }

    .modal--active {
        display: block;
        visibility: visible;
        animation: showModal .2s ease-out forwards;
    }

    /* Modal Content */
    .modal-content {
      position: relative;
      margin: auto;
      width: 90vh;
      max-width: 1200px;
    }
    .thumbnail__image {
        opacity: .70;
        transition: all .3s;
    }
    .thumbnail__image:hover {
        opacity: 1;
        transform: scale(1.07);
    }
    /* The Close Button */
    .close {
      position: absolute;
      top: 1rem;
      right: 1.5rem;
      opacity: .8;
    }

    .close:hover,
    .close:focus {
        opacity: 1;
        cursor: pointer;
    }

    .close:hover {
        transform: scale(1.1);
    }
    
    /* Next & previous buttons */
    .prev,
    .next {
      cursor: pointer;
      position: absolute;
      top: 50%;
      padding: 16px;
      margin-top: -50px;
      opacity: .8;
      transition: all 0.6s ease;
    }

    .next {
      right: -4rem;
    }
    .prev {
      left: -4rem;
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
