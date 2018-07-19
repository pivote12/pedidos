require('./bootstrap');

window.Vue = require('vue');


import VueRouter from 'vue-router';

import clientes from './components/Clientes.vue';
import menusidebar from './components/menu.vue';
import users from './components/user.vue';


Vue.use(VueRouter);

var router = new VueRouter({
  routes: [
    { path: '/clientes', component: clientes },
    { path: '/users', component: users }
  ]
})
//Vue.component('task', require('./components/Task.vue').default);

const app = new Vue({
    el: '#app',
    router: router,
    components:{clientes,menusidebar,users}
});
