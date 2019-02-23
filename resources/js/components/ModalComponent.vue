<template>
    <modal name="comparison" :adaptive="true" width="100%" height="auto" :pivotY="1.0" :clickToClose="false">
        <div class="flex m-6">
            
        <div class="w-5/6">
            <table class="w-full">
                <thead>
                    <th class="w-1/4"></th>
                    <th class="" v-for="product in products">{{ product.name }}</th>
                </thead>
                <template v-if="showContent">
                    <tbody>
                        <tr v-for="attribute in filteredAttributes">
                           <th>{{attribute.name}}</th>
                           <td v-for="value in attribute.values">{{ value }}</td> 
                        </tr>
                        <!-- <div>{{ formatPrice(product.minimumPrice) }}</div>
                        <div>{{ product.shortDescription }}</div> -->
                    </tbody>
                </template>
            <div >
            </div>
            </table>
        </div>
            <button 
                class="ml-auto translateY mt-auto focus:outline-none hover:bg-blue bg-blue-dark font-normal text-white hover:text-white py-3 px-3 border hover:border-transparent rounded"
                :disabled="buttonDisabled"
                @click="showFullComparison"
                >
                {{ showContent ? 'Minimiser' : 'Comparer' }}
            </button>
        </div>
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
                for (let i = 0; i < this.products.length; i++) {
                    let result = [];
                    this.products[i].attributes.forEach((attribute, index) => 
                        {
                            let attValues = []
                            attribute.values.forEach(value => attValues.push(value.name));
                            result.push(
                                {   id: attribute.attribute.id,
                                    name: attribute.attribute.name,
                                    values: attValues  })
                        })
                    results.push(result);
                }
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
                // 
                // let results = [];
                // this.products.forEach(product => {
                //     results.push({
                //             name: product.name,
                //             price: product.minimumPrice,
                //             attributes: {...product.attributes}
                //         })
                // })

                // let final = [];
                // if (results.length > 1) {
                //     results[0].attributes.forEach(att => {
                //         results[1].attributes.forEach(att2 => {
                //             if(att.attribute.id === att2.attribute.id) {
                //                 final.push({name: att.attribute.name, values: [att.values, att2.values]})
                //             }
                //         })
                //     })
                // }
                // return results;
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
    button {
        position: relative;
        z-index: 999999;
    }
    .v--modal-overlay {
      background: transparent;
      height: auto;
    }
</style>
