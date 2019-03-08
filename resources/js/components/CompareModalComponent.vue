<template>
    <transition name="slide-up">
        <div class="modal fixed pin-b bg-white w-full" v-show="products.length > 0">
            <div class="grid-header p-3 bg-blue shadow">
                <span @click="closeModal" class="close__icon cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4">
                        <use class="text-white fill-current" href="/svg/icons.svg#close"></use>
                    </svg>
                </span>
                <h3 v-for="product in products" :key="product.productId" class="font-light tracking-wide text-base text-white">{{ product.name }}</h3>
                <button 
                    class="translateY mr-auto focus:outline-none hover:bg-blue-dark bg-white font-normal text-blue hover:text-white py-3 px-3 border hover:border-transparent rounded"
                    :disabled="buttonDisabled"
                    @click="showFullComparison"
                    >
                    {{ showContent ? 'Minimiser' : 'Comparer' }}
                </button>
            </div>
            <transition 
                @enter="enter"
                @after-enter="afterEnter"
                @leave="leave"
                name=slide-up>
                <div class="content overflow-y-scroll mt-4 mb-10 mx-6" v-if="showContent">
                    <div class="table" v-for="attribute in filteredAttributes" :key="attribute.id">
                        <h5 class="ml-4 text-sm">{{attribute.name}}</h5>
                        <div :key="value + index" v-for="(value, index) in attribute.values">{{ value }}</div>
                    </div>
                </div>
            </transition>
        </div>
    </transition>
</template>

<script>
    export default {
        data() {
            return {
                showContent: false,
            }
        },
        computed: {
            products() {
                return this.$store.getters.comparedProducts;
            },
            buttonDisabled() {
                return this.products.length <= 1;
            },
            filteredAttributes() {
                let results = [];
                this.products.forEach(product => {
                    let result = [];
                    product.attributes.forEach(attribute => 
                    {
                        if (attribute.attribute.id === 3 || attribute.attribute.id === 4 || attribute.attribute.id === 5) return;
                        let attValues = []
                        attValues = attribute.values.map(value => value.name);
                        if (attribute.values.length > 1) {
                            attValues = [attValues.join(', ')];
                        }
                        result.push(
                            {   id: attribute.attribute.id,
                                name: attribute.attribute.name,
                                values: attValues  })
                    })
                    result.push({   id: 'productPrice',
                                    name: 'Prix',
                                    values: [this.formatPrice(product.minimumPrice)]  })
                    results.push(result);
                });
                let final = [];
                if (results.length === 2) {
                    results[0].forEach(result => {
                        results[1].forEach(result2 => {
                            if (result.id === result2.id) {
                                final.push({id: result.id, name: result.name, values: [...result.values, ...result2.values]})
                            }
                        })
                    });
                }
                return final;
            }
        },
        methods: {
            enter(element) {
                const width = getComputedStyle(element).width;
                element.style.width = width;
                element.style.position = 'absolute';
                element.style.visibility = 'hidden';
                element.style.height = 'auto';

                const height = getComputedStyle(element).height;
                element.style.width = null;
                element.style.position = null;
                element.style.visibility = null;
                element.style.height = 0;

                // Force repaint to make sure the animation is triggered correctly.
                getComputedStyle(element).height;

                // Trigger the animation. We use `setTimeout` because we need to make sure the
                // browser has finished painting after setting the `height` to `0` in the line above.
                setTimeout(() => element.style.height = height);
            },
            afterEnter(element) {
                element.style.height = 'auto';
            },
            leave(element) {
                const height = getComputedStyle(element).height;
                element.style.height = height;

                // Force repaint to make sure the animation is triggered correctly.
                getComputedStyle(element).height;

                setTimeout(() => element.style.height = 0);
            },
            showFullComparison() {
                this.showContent = !this.showContent;
            },
            closeModal() {
                this.showContent = false;
                this.$store.dispatch('clearComparedProducts');
            },
        }
    }
</script>

<style scoped>
    .modal {
        max-height: 60vh;
        z-index: 15;
    }
    .content {
        max-height: 50vh;
    }
    button[disabled] {
        background-color: lightgrey;
        opacity: .7;
    }
    .table {
        display: grid;
        grid-template-columns: 15% 35% 35%;
        grid-column-gap: 1rem;
        align-items: center;
    }
    .table::after {
        content: "";
        background-color: lightgrey;
        height: 1px;
        display: block;
        margin: .5rem 0;
        width: 100%;
        grid-column: 1 / -1;
    }
    .table:last-child::after {
        background: none;
    }
    .grid-header {
        display: grid;
        align-items: center;
        grid-template-columns: 15% 35% 35% 15%;
        grid-gap: 1rem;
    }
    .grid-header:before {
        content: '';
        grid-column: 1;
        grid-row: 1;
    }
    button {
        grid-column: 4;
    }
    .slide-up-enter, .slide-up-leave-to {
        opacity: 0;
        height: 0;
        margin-top: 0;
        margin-bottom: 0;
        transform: translateY(3rem);
    }
    .slide-up-enter-active, .slide-up-leave-active {
        transition: all .3s ease-in-out;
        overflow: hidden;
    }
    /* force the browser into optimizing the animation */
    * {
      will-change: height;
      transform: translateZ(0);
      backface-visibility: hidden;
      perspective: 1000px;
    }
</style>
