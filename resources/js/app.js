
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import store from './store';

window.Vue = require('vue');
window.Vue.use(ElementUI);

require('./bootstrap');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vuex.component(key.split('/').pop().split('.')[0], files(key)))

Vue.component('flash-component', require('./components/FlashComponent.vue').default);
Vue.component('compare-modal-component', require('./components/CompareModalComponent.vue').default);
Vue.component('search-box-component', require('./components/SearchBoxComponent.vue').default);
Vue.component('checkout-component', require('./components/CheckoutComponent.vue').default);
Vue.component('carousel-component', require('./components/CarouselComponent.vue').default);
Vue.component('address-component', require('./components/profile/AddressComponent.vue').default);
Vue.component('stars-component', require('./components/product/StarsComponent.vue').default);
Vue.component('add-to-cart-component', require('./components/product/AddToCartComponent.vue').default);
Vue.component('favorite-component', require('./components/product/FavoriteComponent.vue').default);
Vue.component('review-component', require('./components/product/ReviewComponent.vue').default);
Vue.component('product-images-component', require('./components/product/ProductImagesComponent.vue').default);
Vue.component('search-component', require('./components/search/SearchComponent.vue').default);
Vue.component('sign-up-component', require('./components/Auth/SignUpComponent.vue').default);
Vue.component('logout-component', require('./components/Auth/LogoutComponent.vue').default);
Vue.component('basket-component', require('./components/basket/BasketComponent.vue').default);
Vue.component('update-quantity-component', require('./components/basket/UpdateQuantityComponent.vue').default);
Vue.component('discount-component', require('./components/basket/DiscountComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
window.Vue.mixin({
    methods: {
        route: route,
        formatPrice(price) {
            price = price.toFixed(2) + '';
            return price.replace('.', ',') + ' €';
        },
    }
})

const app = new Vue({
    store,
    el: '#app'
});