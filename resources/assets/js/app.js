
require('./bootstrap');

window.Vue = require('vue');

window.Axios = require('axios').default;

Vue.component('post-like', require('./components/PostLikeComponent.vue'));
Vue.component('post-view', require('./components/PostViewComponent.vue'));
Vue.component('posts', require('./components/Admin/Post.vue'));

const app = new Vue({
    el: '#app'
});
