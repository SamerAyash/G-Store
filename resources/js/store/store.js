import Vue from "vue";
import Vuex from 'vuex'
Vue.use(Vuex);
import users from './modules/Users.js'
const store =new Vuex.Store({
    strict:true,
    modules:{
        users:users,
    }
});

export default store;
