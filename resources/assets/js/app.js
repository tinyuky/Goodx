
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
 import resultQuiz from './components/quiz/resultQuiz.vue';
 import thankQuiz from './components/quiz/thankQuiz.vue';

 const routes = [
     {path: '/', component: welcomeQuiz, name: 'quiz-welcome'},
     {path: '/show', component: showQuiz, name: 'quiz-show'},
     {path: '/result/:correct', component: resultQuiz, name: 'quiz-result'},
     {path: '/thank', component: thankQuiz, name: 'quiz-thank'}
 ]
 const router = new VueRouter({ routes })

 const app = new Vue({ router }).$mount('#app')
