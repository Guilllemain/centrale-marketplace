import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'
import createPersistedState from 'vuex-persistedstate'

Vue.use(Vuex)

export default new Vuex.Store({
  plugins: [createPersistedState()],

  state: {
    comparedProducts: [],
    selectedFacets: [],
    basketContent: null
  },

  getters: {
    comparedProducts(state) {
      return state.comparedProducts;
    },
    selectedFacets(state) {
      return state.selectedFacets;
    },
    basketContent(state) {
      return state.basketContent;
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
    },

    updateBasket(state, basket) {
      state.basketContent = basket;
    },
    clearBasket(state) {
      state.basketContent = null;
    }
  },

  actions: {
    clearComparedProducts({commit}) {
      commit('clearComparedProducts');
    },
    clearBasket({commit}) {
      commit('clearBasket');
    },
    async getBasketContent({commit}) {
      const response = await axios.get('/basket');
      commit('updateBasket', response.data);
    }
  }
})