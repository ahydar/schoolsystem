
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./custom2');

pace.start();
window.Vue = require('vue');

import Notifications from 'vue-notification';
import VueRouter from 'vue-router';
import router from './routes';


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.use(Notifications);
Vue.use(VueRouter);
Vue.component('example', require('./components/Example.vue'));
Vue.component('modal', require('./components/Modal.vue'));
Vue.component('datatable', require('./components/Table.vue'));
Vue.component('confirm', require('./components/Confirm.vue'));

//Vue.component('home', require('./views/Home.vue'));
//Vue.component('about', require('./views/About.vue'));

Vue.component('accounts', require('./entrance/Accounts.vue'));

const app = new Vue({
    el: '#app',
    router:router,
    data:{
        pageHead:'App'
    }
});
