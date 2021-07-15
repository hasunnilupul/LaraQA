require('./bootstrap');
require('alpinejs');

import Vue from 'vue'
import VueIziToast from 'vue-izitoast';

import 'izitoast/dist/css/iziToast.min.css';

Vue.config.productionTip = false;

//Globally registered components
import UserInfo from './components/UserInfo.vue';
import Answer from './components/Answer.vue';
import Favourite from './components/Favourite.vue';

Vue.component('user-info', UserInfo);
Vue.component('answer', Answer);
Vue.component('favourite', Favourite);

//Plugins
Vue.use(VueIziToast);

const app = new Vue({
    el: '#app'
});