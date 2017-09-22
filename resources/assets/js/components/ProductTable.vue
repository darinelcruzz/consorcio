<template lang="html">
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th v-for="head in header" :style="head.width" align="center">{{ head.name }}</th>
                </tr>
            </thead>
            <tbody>
                <product-row :products="products" :num="1"
                    @subtotal="addToTotal">
                </product-row>
                <product-row :products="products" :num="2"
                    @subtotal="addToTotal">
                </product-row>
                <product-row :products="products" :num="3"
                     @subtotal="addToTotal">
                </product-row>
                <product-row :products="products" :num="4"
                    @subtotal="addToTotal">
                </product-row>
                <product-row :products="products" :num="5"
                    @subtotal="addToTotal">
                </product-row>
            </tbody>
            <tfoot>
                <template v-if="retainer">
                    <tr>
                        <td colspan="3"></td>
                        <td>
                            Subtotal:
                        </td>
                        <td>
                            {{ total | currency}}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                        <td>
                            - Anticipo:
                        </td>
                        <td>
                            {{ retainer | currency}}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                        <td>
                            <b>Total:</b>
                        </td>
                        <td >
                            {{ total - retainer | currency }}
                            <input type="hidden" name="amount" :value="total - retainer">
                        </td>
                    </tr>
                </template>

                <tr v-else>
                    <td colspan="3"></td>
                    <td>
                        <b>Total:</b>
                    </td>
                    <td>
                        {{ total | currency }}
                        <input type="hidden" name="amount" :value="total">
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
                { name:'Material', width: 'width: 35%' },
                { name:'Cantidad', width: 'width: 15%' },
                { name:'Precio', width: 'width: 20%' },
                { name:'Importe', width: 'width: 20%' },
            ],
            articles: [
                1, 0, 0, 0, 0
            ],
            subtotals: [0, 0, 0, 0, 0],
            total: 0,
        };
    },
    props: ['products', 'retainer'],

    methods: {
        addToTotal(total, num) {
            this.subtotals[num - 1] = total;

            this.total = this.subtotals.reduce(function (total, value) {
                return total + value;
            }, 0);
        }
    },

    filters: {
        currency: function (value) {
          return '$ ' + value.toFixed(2);
        }
    },
}
</script>
