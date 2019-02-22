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
      if (state.comparedProducts.length >= 3) {
        return flash('Vous ne pouvez pas comparer plus de 3 produits', 'warning');
      }
      state.comparedProducts.push(product);
    }
  },
  actions: {
  }
})