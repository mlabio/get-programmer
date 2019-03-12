import Vue from 'vue';
import Router from 'vue-router';
Vue.use(Router);

const routes = [
  {
    path: '/dashboard',
    name: 'dashboard',
    title: 'Dashboard',
    component: require('./components/Dashboard.vue')
  },
  {
    path: '/profile',
    name: 'profile',
    title: 'Profile',
    component: require('./components/Profile.vue')
  },
  {
    path: '/users',
    name: 'users',
    title: 'Users',
    component: require('./components/Users.vue')
  },
  {
    path: '*',
    redirect: { name: 'dashboard' },
  },
];

export default new Router({
  mode: 'history',
  routes
});