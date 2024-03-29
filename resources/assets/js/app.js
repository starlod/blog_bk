
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./helper');
require('./filter');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

window.VueMarkdown = require('vue-markdown');
Vue.use(VueMarkdown);

// Vue.component('example', require('./components/Example.vue'));
// Vue.component('vue-markdown', VueMarkdown);
Vue.component('posts', require('./components/posts.vue'));
Vue.component('post', require('./components/post.vue'));
Vue.component('pagination', require('./components/pagination.vue'));
Vue.component('image_uploader', require('./components/image_uploader.vue'));
Vue.component('images', require('./components/images.vue'));
Vue.component('items', require('./components/items.vue'));
Vue.component('gallery', require('./components/gallery.vue'));
Vue.component('lightbox', require('./components/lightbox.vue'));

Vue.config.devtools = true;

const app = new Vue({
    el: '#app'
});
