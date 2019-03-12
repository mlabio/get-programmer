require('./bootstrap');

window.Vue = require('vue');
import router from './routes';
import { Form, HasError, AlertError } from 'vform'

window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

const app = new Vue({
    el: '#app',
    router
});
