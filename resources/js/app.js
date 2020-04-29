/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

$('.deletePhotoBttn').on('click', function (event) {

    let $button = $(this);

    let data = {
        client_id: $button.closest('form').data('client-id')
    };

    $.ajax({
        url: '/clients/' + data.client_id + '/delete-photo',
        data: data,
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        async: true,
        cache: false,
        processData: true,
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            alert(errorThrown)
        },
        success: function (response, textStatus, jqXHR) {
            $button.closest('.ui.card').remove();
        },
    });
});

$('.deleteClientBttn').on('click', function (event) {

    let $button = $(this);

    let clientId = $button.closest('.ui.card').data('client-id');

    $.ajax({
        url: '/clients/' + clientId,
        data: {
            _method: 'DELETE'
        },
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        async: true,
        cache: false,
        processData: true,
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
            alert(errorThrown)
        },
        success: function (response, textStatus, jqXHR) {
            window.location.href = response.url;
        },
    });
});
