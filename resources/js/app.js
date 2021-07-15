require('./bootstrap');
require('alpinejs');

import Vue from 'vue'

//Components
import UserInfo from './components/UserInfo.vue'


const app = new Vue({
    el: '#app',
    components: {
        UserInfo,
    }
});