import Vue from 'vue'
import emojione from 'emojione';

Vue.filter('with_emoji', function (input) {
    return emojione.shortnameToUnicode(input)
})