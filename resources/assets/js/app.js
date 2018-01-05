
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));
Vue.component('product-table', require('./components/ProductTable.vue'));
Vue.component('product-row', require('./components/ProductRow.vue'));

Vue.component('row-woc', require('./components/lte/SingleElementRow.vue'));
Vue.component('solid-box', require('./components/lte/SolidBox.vue'));

Vue.component('data-table', require('./components/lte/DataTable.vue'));
Vue.component('data-table-com', require('./components/lte/SmallDataTable.vue'));

Vue.component('nav-tabs', require('./components/lte/NavTabsPane.vue'));
Vue.component('client-info', require('./components/lte/ClientInfo.vue'));

Vue.component('select2', require('./components/SelectTwo.vue'));


const app = new Vue({
    el: '#app',
    data: {
        clients: [],
        clients2: [],
        client_id: '',
        checked: [],
        price_id: '',
        shipp: '',
    },
    created() {
        axios.get('/clients').then(response => {
            this.clients = response.data;
        });

        axios.get('/clients2').then(response => {
            this.clients2 = response.data;
        });
    }

});
