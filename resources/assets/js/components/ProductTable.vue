<template lang="html">
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th v-for="head in header" :style="head.width" align="center">{{ head.name }}</th>
                </tr>
            </thead>
            <tbody>
                <product-row :products="products" :pricetype="pricetype" :num="1"
                    @subtotal="addToTotal">
                </product-row>
                <product-row :products="products" :pricetype="pricetype" :num="2"
                    @subtotal="addToTotal">
                </product-row>
                <product-row :products="products" :pricetype="pricetype" :num="3"
                     @subtotal="addToTotal">
                </product-row>
                <product-row :products="products" :pricetype="pricetype" :num="4"
                    @subtotal="addToTotal">
                </product-row>
                <product-row :products="products" :pricetype="pricetype" :num="5"
                    @subtotal="addToTotal">
                </product-row>
            </tbody>

            <tfoot>
                <tr>
                    <td colspan="3"></td>
                    <td><b>Total:</b></td>
                    <td>
                        {{ total }}
                        <input type="hidden" name="total" :value="total">
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</template>

<script>
export default {
    data() {
        return {
            header: [
                { name:'#', width: 'width: 5%' },
                { name:'Producto', width: 'width: 35%' },
                { name:'Cantidad', width: 'width: 15%' },
                { name:'Precio', width: 'width: 20%' },
                { name:'Importe', width: 'width: 20%' },
            ],
            products: [],
            subtotals: [0, 0, 0, 0, 0],
            total: 0,
        };
    },
    props: ['pricetype'],

    methods: {
        addToTotal(total, num) {
            this.subtotals[num - 1] = total;

            this.total = this.subtotals.reduce(function (total, value) {
                return total + value;
            }, 0);
        }
    },

    created() {
        axios.get('/products').then(response => {
            this.products = response.data;
        });
    }
}
</script>
