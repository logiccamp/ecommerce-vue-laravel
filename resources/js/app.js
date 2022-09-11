require('./bootstrap');

window.Vue = require('vue').default;

import Vue from 'vue';
import VueToaster from 'vue-toastr'
Vue.use(VueToaster)


Vue.component('add-to-cart', require('./components/AddtoCart.vue').default);
Vue.component('cart-items', require('./components/Cart.vue').default);
Vue.component('cart-page', require('./components/cartPage.vue').default);
Vue.component('add-cart-button', require('./components/ProductCartBtn').default);
Vue.component('order-page', require('./components/orderPage').default);
Vue.component('order-message', require('./components/orderMessage').default);
Vue.component('square', require('./components/Square').default);

const app = new Vue({
    el: '#app',
});
