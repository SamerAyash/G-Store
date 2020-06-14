require('./bootstrap');

window.Vue = require('vue');
/////////////////////////////// Bootstrap-vue ///////////////
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';
import axios from 'axios';
import VueRouter from 'vue-router'
import routes from "./router";
Vue.use(BootstrapVue);
Vue.use(axios);
Vue.use(IconsPlugin);
Vue.use(VueRouter);
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';

Vue.component('requests-table',require('./components/requestsTable').default);
Vue.component('product-component',require('./components/productComponent').default);
Vue.component('register-component',require('./components/registerComponent').default);
Vue.component('cart-component',require('./components/cartComponent').default);
//////////////////////////////////////////////////////////////
const router = new VueRouter({
    mode:'history',
    history: true,
    hashbang: false,
    linkActiveClass: 'active',
    routes : routes,
});
//////////////////////////////////////////////////////////////
import store from "./store/store.js";
//////////////////////////////////////////////////////////////
const app = new Vue({
    el: '#app',
    router,
    store,
});
