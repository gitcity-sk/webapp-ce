window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//Vue.component('monaco-editor', require('./components/ide.vue'));

import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import ide from './components/ide'
import editor from './components/editor'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/-/editor/',
            name: 'home',
            component: ide
        }
    ],
});

const app = new Vue({
    el: '#app',
    components: { editor },
    router,
    data () {
        return {
            loading: false
        }
    },
    created () {
        this.$on('pageLoader', function(value) {
            this.loading = value
        })
    }
});
