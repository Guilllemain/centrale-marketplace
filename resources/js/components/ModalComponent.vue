<template>
    <div class="fixed pin-b bg-white w-full" v-show="products.length > 0">
        <div class="grid-header p-3 bg-blue shadow">
            <span @click="closeModal" class="close__icon cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4">
                    <use class="text-white fill-current" href="/svg/icons.svg#close"></use>
                </svg>
            </span>
            <h3 v-for="product in products" class="font-light tracking-wide text-base text-white">{{ product.name }}</h3>
            <button 
                class="translateY mr-auto focus:outline-none hover:bg-blue-dark bg-white font-normal text-blue hover:text-white py-3 px-3 border hover:border-transparent rounded"
                :disabled="buttonDisabled"
                @click="showFullComparison"
                >
                {{ showContent ? 'Minimiser' : 'Comparer' }}
            </button>
        </div>
        <div class="table mt-4 mb-10 mx-6" v-if="showContent">
            <template v-for="attribute in filteredAttributes">
                <h5 class="ml-4 text-sm">{{attribute.name}}</h5>
                <div v-for="value in attribute.values">{{ value }}</div>
                <div class="h-bar"></div>
            </template>
        </div>
            <!-- <table class="w-full">
                <thead>
                    <th class="w-1/5"></th>
                    <th class="" v-for="product in products">{{ product.name }}</th>
                </thead>
                <template v-if="showContent">
                    <tbody>
                        <tr v-for="attribute in filteredAttributes">
                           <th>{{attribute.name}}</th>
                           <td v-for="value in attribute.values">{{ value }}</td> 
                        </tr>
                    </tbody>
                </template>
            </table> -->
            
    </div>
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
                                final.push({name: result.name, values: [...result.values, ...result2.values]})
                            }
                        })
                    });
                }
                return final;
                
                // let results = [];
                // this.products.forEach(product => {
                //     results.push({
                //             name: product.name,
                //             id: product.productId,
                //             price: product.minimumPrice,
                //             attributes: [...product.attributes]
                //         })
                // })

                // let final = [];
                // if (results.length > 1) {
                //     results[0].attributes.forEach(att => {
                //         results[1].attributes.forEach(att2 => {
                //             if(att.attribute.id === att2.attribute.id) {
                //                 final.push({name: att.attribute.name, values: [...att.values, ...att2.values]})
                //             }
                //         })
                //     })
                // }
                // return final;
            }
        },
        methods: {
            showFullComparison() {
                this.showContent = !this.showContent;
            },
            closeModal() {
                this.$store.dispatch('clearComparedProducts');
                this.$modal.hide('comparison');
            },
            formatPrice(price) {
                price = price.toFixed(2) + '';
                return price.replace('.', ',') + ' €';
            },
        }
    }
</script>

<style scoped>
    button[disabled] {
        background-color: lightgrey;
        opacity: .7;
    }
    .v--modal-overlay {
      background: none;
      height: auto;
    }
    .table {
        display: grid;
        grid-template-columns: 15% 35% 35%;
        grid-column-gap: 1rem;
        align-items: center;
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
    .h-bar {
        grid-column: 1 / -1;
    }
    .h-bar:last-child {
        display: none;
        visibility: hidden;
    }
</style>
