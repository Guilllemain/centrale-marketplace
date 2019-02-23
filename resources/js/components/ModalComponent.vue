<template>
    <modal name="comparison" :adaptive="true" width="100%" height="auto" :pivotY="1.0" :clickToClose="false">
        <div class="grid-header p-4 bg-blue">
            <div v-for="product in products" class="text-base text-white">{{ product.name }}</div>
            <button 
                class="translateY mr-auto focus:outline-none hover:bg-blue bg-blue-dark font-normal text-white hover:text-white py-3 px-3 border hover:border-transparent rounded"
                :disabled="buttonDisabled"
                @click="showFullComparison"
                >
                {{ showContent ? 'Minimiser' : 'Comparer' }}
            </button>
        </div>
        <div class="table my-4 mx-6" v-if="showContent">
            <template v-for="attribute in filteredAttributes">
               <div class="ml-4">{{attribute.name}}</div>
               <div v-for="value in attribute.values">{{ value }}</div>
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
            
    </modal>
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
                        attribute.values.forEach(value => attValues.push(value.name));
                        result.push(
                            {   id: attribute.attribute.id,
                                name: attribute.attribute.name,
                                values: attValues  })
                    })
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
            formatPrice(price) {
                price = price.toFixed(2) + '';
                return price.replace('.', ',');
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
    .v--modal-overlay .v--modal-background-click {
        position: absolute;
        bottom: 0;
    }
    .table {
        display: grid;
        grid-template-columns: 15% 35% 35%;
        grid-gap: 1rem;
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
</style>
