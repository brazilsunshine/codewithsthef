import './bootstrap';

import axios from 'axios';
import router from './routes';
import store from './store';
import Vue from 'vue';
import vClickOutside from 'v-click-outside';
import VueRouter from 'vue-router';
import VueToastify from 'vue-toastify';
import VueXData from 'vue-x-data';


import RootContainer from './components/RootContainer';

window.axios = axios;

Vue.use(vClickOutside)
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
    components: {
        RootContainer
    }
});
