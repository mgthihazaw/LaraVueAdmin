

require('./bootstrap');

window.Vue = require('vue');
import { Form, HasError, AlertError } from 'vform'
import moment from 'moment';
window.form=Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

import VueProgressBar from 'vue-progressbar';


Vue.use(VueProgressBar, {
  color: 'rgb(143, 255, 199)',
  failedColor: 'red',
  height: '2px'
})

import swal from 'sweetalert2';
window.swal=swal;
const toast = swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000
});
window.toast=toast;



Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.filter('upText',function(text){
	return text.charAt(0).toUpperCase() + text.slice(1)
})
Vue.filter('myDate',function(created){
	return moment().format("MMM Do YY");
})

import router from './Router/router.js';
const app = new Vue({
    el: '#app',
    router
});
