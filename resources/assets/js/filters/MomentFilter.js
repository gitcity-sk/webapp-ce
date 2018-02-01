import Vue from 'vue'
import moment from 'moment'

Vue.filter('moment', function (date) {
    return moment(date).fromNow();
})