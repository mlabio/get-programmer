require('./bootstrap');

import Vue from 'vue';
import router from './routes';
import { Form, HasError, AlertError } from 'vform';
import VueProgressBar from 'vue-progressbar';
import moment from 'moment';
import Swal from 'sweetalert2';
import Multiselect from 'vue-multiselect'
    
//global
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
Vue.component('pagination', require('laravel-vue-pagination'));
Vue.component('multiselect', Multiselect)

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});

const options = {
    color: '#bffaf3',
    failedColor: '#874b4b',
    thickness: '5px',
    transition: {
      speed: '2.5',
      opacity: '0.6s',
      termination: 300
    },
    autoRevert: true,
    location: 'top',
    inverse: false
}

window.Toast = Toast;
window.Swal = Swal;
window.Form = Form;
window.moment = moment;
window.Fire = new Vue();

//dependencies
Vue.use(VueProgressBar, options)

const app = new Vue({
    el: '#app',
    router
});

