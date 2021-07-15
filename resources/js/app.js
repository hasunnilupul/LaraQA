require('./bootstrap');
require('alpinejs');

import Vue from 'vue'

Vue.config.productionTip = false;

//Globally registered components
import UserInfo from './components/UserInfo.vue'
import Answer from './components/Answer.vue'

Vue.component('user-info', UserInfo);
Vue.component('answer', Answer);

const app = new Vue({
    el: '#app'
});