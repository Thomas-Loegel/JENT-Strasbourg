/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import '../css/app.css';

// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
// import $ from 'jquery';

console.log('Hello Webpack Encore! Edit me in assets/js/app.js');

import Vue from 'vue'
import App from './App.vue'
import Test from './Test.vue'

new Vue({
    el: "#app",
    template: "<App />",
    components: {App}
})

new Vue({
    el: "#test",
    template: "<Test />",
    components: {Test}
})