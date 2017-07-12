<template lang="html">
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th v-for="head in header" :style="head.width">{{ head.name }}</th>
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
                        <td></td><td></td><td></td><td></td>
                        <td>
                            Subtotal:
                        </td>
                        <td>
                            $ {{ total }}
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td><td></td><td></td><td></td>
                        <td>
                            - Anticipo:
                        </td>
                        <td>
                            $ {{ retainer }}
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td><td></td><td></td><td></td>
                        <td>
                            <b>Total:</b>
                        </td>
                        <td >
                            $ {{ total - retainer }}
                            <input type="hidden" name="amount" :value="total - retainer">
                        </td>
                        <td></td>
                    </tr>
                </template>

                <tr v-else>
                    <td></td><td></td><td></td><td></td>
                    <td>
                        <b>Total:</b>
                    </td>
                    <td >
                        $ {{ total }}
                        <input type="hidden" name="amount" :value="total">
                    </td>
                    <td></td>
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
                { name:'Cantidad', width: 'width: 15%' },
                { name:'Unidad', width: 'width: 10%' },
                { name:'Material', width: 'width: 30%' },
                { name:'Precio unitario', width: 'width: 15%' },
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
}
</script>
