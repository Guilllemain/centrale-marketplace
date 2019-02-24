import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from 'vuex-persistedstate'

Vue.use(Vuex)

export default new Vuex.Store({
  plugins: [createPersistedState()],
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
    },
    clearComparedProducts(state) {
      state.comparedProducts = [];
    },
    isProductCompared(state, product) {
      return state.comparedProducts.includes(product);
    }
  },
  actions: {
    clearComparedProducts({commit}) {
      commit('clearComparedProducts');
    },
    isProductCompared({commit}, product) {
      commit('isProductCompared', product);
    }
  }
})