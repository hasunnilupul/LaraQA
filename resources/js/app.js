require('./bootstrap');
require('alpinejs');

import Vue from 'vue'
import VueIziToast from 'vue-izitoast';
import Authorization from './authorization/authorize';

import 'izitoast/dist/css/iziToast.min.css';

Vue.config.productionTip = false;

//Globally registered components
import UserInfo from './components/UserInfo.vue';
import Vote from './components/Vote.vue';
import Answers from './components/Answers.vue';

Vue.component('user-info', UserInfo);
Vue.component('vote', Vote);
Vue.component('answers', Answers);

//Plugins
Vue.use(VueIziToast);
Vue.use(Authorization);

const app = new Vue({
    el: '#app'
});