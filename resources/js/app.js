
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');

import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';

window.Vue = require('vue');
window.Event = new Vue();
window.Vue.use(ElementUI);


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key)))

Vue.component('search-component', require('./components/SearchComponent.vue').default);
Vue.component('search-box-component', require('./components/SearchBoxComponent.vue').default);
Vue.component('basket-component', require('./components/BasketComponent.vue').default);
Vue.component('address-component', require('./components/AddressComponent.vue').default);
Vue.component('checkout-component', require('./components/CheckoutComponent.vue').default);
Vue.component('stars-component', require('./components/StarsComponent.vue').default);
Vue.component('favorite-component', require('./components/FavoriteComponent.vue').default);
Vue.component('carousel-component', require('./components/CarouselComponent.vue').default);
Vue.component('product-images-component', require('./components/ProductImagesComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

var mixin = {
  methods: {
    route: route
  }
}


const app = new Vue({
    mixins: [mixin],
    el: '#app'
});