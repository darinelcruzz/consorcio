
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

Vue.component('dropdown', require('./components/lte/DropdownButton.vue'));
Vue.component('ddi', require('./components/lte/DropdownItem.vue'));

Vue.component('nav-tabs', require('./components/lte/NavTabsPane.vue'));
Vue.component('client-info', require('./components/lte/ClientInfo.vue'));
Vue.component('client-select', require('./components/ClientSelect.vue'));
Vue.component('client-credit', require('./components/ClientCredit.vue'));

Vue.component('select2', require('./components/SelectTwo.vue'));
Vue.component('sale', require('./components/Sale.vue'));
Vue.component('sales-table', require('./components/SalesTable.vue'));
Vue.component('client', require('./components/Client.vue'));
Vue.component('clients-table', require('./components/ClientsTable.vue'));
Vue.component('client-sales', require('./components/ClientSales.vue'));
Vue.component('client-sale', require('./components/ClientSale.vue'));

Vue.component('deposits-table', require('./components/DepositsTable.vue'));


const app = new Vue({
    el: '#app',
    data: {
        selected_date: '',
        checked: [],
        price_id: '',
        shipp: '',
    },
});
