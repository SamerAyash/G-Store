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
/*
import './custom.scss';
*/
Vue.component('requests-table',require('./components/requestsTable').default);
//////////////////////////////////////////////////////////////
const router = new VueRouter({
    history: true,
    hashbang: false,
    routes : routes,
});
const app = new Vue({
    el: '#app',
    router,
});
