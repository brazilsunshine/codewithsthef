import './bootstrap';

import axios from 'axios';
import router from './routes';
import store from './store';

import Vue from 'vue';
import Vue2Editor from "vue2-editor";
import VueLocalStorage from 'vue-localstorage';
import VueI18n from 'vue-i18n';
import i18n from './i18n';
import LaravelPermissionToVueJS from 'laravel-permission-to-vuejs'
import vClickOutside from 'v-click-outside';
import VueRouter from 'vue-router';
import VueToastify from 'vue-toastify';
import VueXData from 'vue-x-data';
import Datepicker from 'vue2-datepicker';


Vue.component('datepicker', Datepicker);

import RootContainer from './components/RootContainer';

window.axios = axios;

Vue.use(Vue2Editor);
Vue.use(VueLocalStorage);
Vue.use(VueI18n);
Vue.use(LaravelPermissionToVueJS)
Vue.use(vClickOutside);
Vue.use(VueRouter);
Vue.use(VueXData);

Vue.use(VueToastify, {
    theme: 'light',
    errorDuration: 5000,
});


let app = new Vue({
    el: '#app',
    router,
    store,
    i18n,

    components: {
        RootContainer
    }
});
