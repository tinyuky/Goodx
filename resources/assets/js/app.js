
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
 require('./bootstrap');

 window.Vue = require('vue');
 import VueRouter from 'vue-router';
 import VeeValidate from 'vee-validate';
 import Vue from 'vue';
 window.Vue.use(VueRouter);
 Vue.use(VeeValidate);

 import welcomeQuiz from './components/quiz/welcomeQuiz.vue';
 import showQuiz from './components/quiz/showQuiz.vue';

 const routes = [
     {path: '/', component: welcomeQuiz, name: 'welcome'},
     {path: '/show', component: showQuiz, name: 'show'},
 ]
 const router = new VueRouter({ routes })

 const app = new Vue({ router }).$mount('#app')
