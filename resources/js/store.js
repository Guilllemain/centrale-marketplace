import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from 'vuex-persistedstate'

Vue.use(Vuex)

export default new Vuex.Store({
  plugins: [createPersistedState()],

  state: {
    comparedProducts: [],
    selectedFacets: []
  },

  getters: {
    comparedProducts(state) {
      return state.comparedProducts;
    },
    selectedFacets(state) {
      return state.selectedFacets;
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

    addFacet(state, facet) {
      state.selectedFacets.push(facet);
    },
    deleteFacet(state, facet) {
      state.selectedFacets.splice(facet, 1);
    },
    clearFacets(state) {
      state.selectedFacets = [];
    }
  },

  actions: {
    clearComparedProducts({commit}) {
      commit('clearComparedProducts');
    }
  }
})