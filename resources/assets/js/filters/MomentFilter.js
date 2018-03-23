import Vue from 'vue'
import moment from 'moment'

Vue.filter('moment', function (date) {
    //if (moment(date) < moment().startOf('month')) return moment(date).format("MMM Do YY");
    return moment(date).fromNow();
});

Vue.filter('momentFormated', function (date) {
    return moment(date).format("MMM Do YY, h:mm:ss a");
});