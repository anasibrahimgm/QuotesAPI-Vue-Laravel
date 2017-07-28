
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import App from './App.vue'

// npm install vue-router -save
import VueRouter from 'vue-router'
import Routes from './routes'

Vue.use(VueRouter);

const router = new VueRouter({
  mode: 'history',
  routes: Routes
});

const app = new Vue({
  components: {
    'myapp': App,
  },
    el: '#app',
    router: router,
    //render: h => h(App)
});
