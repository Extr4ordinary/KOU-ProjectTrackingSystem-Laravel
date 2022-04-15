/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

import Vuelidate from 'vuelidate';
Vue.use(Vuelidate);
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('main-comp',require('./components/client/home/Home.vue').default);
Vue.component('sidebar-comp',require('./components/client/layouts/Sidebar.vue').default)
Vue.component('add-user',require('./components/client/kullanici_ekle/AddUser.vue').default)
Vue.component('donem',require('./components/client/donem/donem.vue').default)
Vue.component('ogrenci-odev',require('./components/client/ogrenci_odev/OgrenciOdev.vue').default)
Vue.component('hoca-odev-list',require('./components/client/hoca_odev_list/HocaOdevList.vue').default)
Vue.component('ogrenci-list',require('./components/client/hoca_odev_list/OgrenciList.vue').default)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
