require('./bootstrap');
require('alpinejs');

import Vue from 'vue'
import VueIziToast from 'vue-izitoast';
import Authorization from './authorization/authorize';

import 'izitoast/dist/css/iziToast.min.css';

Vue.config.productionTip = false;

//Globally registered components
import Question from './components/Question.vue';
import UserInfo from './components/UserInfo.vue';
import Vote from './components/Vote.vue';
import Answers from './components/Answers.vue';
import NewAnswer from './components/NewAnswer.vue';

Vue.component('question', Question);
Vue.component('user-info', UserInfo);
Vue.component('vote', Vote);
Vue.component('answers', Answers);
Vue.component('new-answer', NewAnswer);

//Plugins
Vue.use(VueIziToast);
Vue.use(Authorization);

const app = new Vue({
    el: '#app',
});