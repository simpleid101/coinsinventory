
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app'
});

$(document).ready(function(){
    $('#coins-table').DataTable({
        serverSide: true,
        ajax: {
            url: '/search',
            type: 'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        },
        "columns": [
            { "data": "id" },
            { "data": "bag_number" },
            { "data": "field_inventory" },
            { "data": "emperor" },
            { "data": "denomination" },
            { "data": "name" },
            { "data": "mark" },
            { "data": "weight" },
            { "data": "diameter" },
            { "data": "emission" },
            { "data": "axis" },
            { "data": "find_date" },
            { "data": "reference" },
            { "data": "square" }

          ]
    });
    $("#coins-table").on('click', 'tr', function(){
        $td = $(this).children().first();
        $(this).attr('href', '/coins/' + $td.html());
        window.location = $(this).attr('href');
    })
});