import Vue from 'vue'
import App from './App.vue'

// npm install vue-router -save
import VueRouter from 'vue-router'
import Routes from './routes'

Vue.use(VueRouter);

const router = new VueRouter({
  mode: 'history',
  routes: Routes
});

new Vue({
  el: '#app',
  router: router,
  render: h => h(App)
})
