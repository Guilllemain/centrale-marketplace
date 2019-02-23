import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    comparedProducts: []
  },
  getters: {
    comparedProducts(state) {
      return state.comparedProducts;
    }
  },
  mutations: {
    addProductToCompare(state, product) {
      state.comparedProducts.push(product);
    },
    removeProductFromCompare(state, product) {
      state.comparedProducts.splice(product, 1);
    }
  },
  actions: {
  }
})