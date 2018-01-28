
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./emojione-convert');
require('./fontawesome-all');
require('./directives/TooltipDirective');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('profile-view-component', require('./components/profiles/ProfileViewComponent.vue'));
Vue.component('projects-table-component', require('./components/projects/ProjectsTableComponent.vue'));
Vue.component('tree-table-component', require('./components/git/TreeTableComponent.vue'));
Vue.component('groups-table-component', require('./components/groups/GroupsTableComponent.vue'));
Vue.component('group-projects-table-component', require('./components/groups/GroupProjectsTableComponent.vue'));

const app = new Vue({
    el: '#app',
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
