require('./bootstrap');
window.Vue = require('vue').default;
import Vue from 'vue';
import VueChatScroll from 'vue-chat-scroll'
Vue.use(VueChatScroll)
const VueUploadComponent = require('vue-upload-component')
Vue.component('file-upload', VueUploadComponent)

Vue.component('chat-component', require('./components/Chat.vue').default);

const app = new Vue({
    el: '#app',
    data() {
        return {
            totalUncount: 0,
            alreadyOpen: false
        };
    },
});