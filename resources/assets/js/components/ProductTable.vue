<template lang="html">
    <div class="table-responsive">
        <table v-if="items.length > 0" class="table table-striped">
            <thead>
                <tr>
                    <th style="width: 5%;"><i class="fa fa-times"></i></th>
                    <th style="width: 20%;">Producto</th>
                    <th style="width: 15%;">Precio</th>
                    <th style="width: 15%;">Cantidad</th>
                    <th style="width: 15%;">Kg</th>
                    <th style="width: 15%;">Cajas</th>
                    <th style="width: 15%;">Importe</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in items" is="product-row" :item="item" :index="index" :key="item.id" :model="model"></tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2"></td>
                    <th><small>TOTALES</small></th>
                    <td style="text-align: center;">
                        {{ chicken }}
                        <input type="hidden" name="chickens" :value="chicken">
                        <input type="hidden" name="quantity" :value="chicken">
                    </td>
                    <td style="text-align: center;">
                        {{ kg.toFixed(2) }}
                        <input type="hidden" name="kg" :value="kg">
                    </td>
                    <td style="text-align: center;">
                        {{ boxes }}
                        <input type="hidden" name="boxes" :value="boxes">
                    </td>
                    <td style="text-align: right;">
                        {{ total.toFixed(2) }}
                        <input name="amount" type="hidden" :value="amount">
                    </td>
                </tr>
                <tr>
                    <td colspan="5"></td>
                    <th><small>AJUSTE</small></th>
                    <td>
                        <input type="number" step="0.01" class="form-control" v-model.number="rounding">
                    </td>
                </tr>
                <tr>
                    <td colspan="5"></td>
                    <th><small>IMPORTE TOTAL</small></th>
                    <td style="text-align: right;">{{ amount.toFixed(2) }}</td>
                </tr>
            </tfoot>
        </table>

        <div v-else>
            <code>No se han agregado productos</code>
        </div>
    </div>
</template>

<script>
export default {
    props: ['stored', 'model', 'samount'],
    data() {
        return {
            items: [],
            chickens: [],
            kgs: [],
            boxesT: [],
            amounts: [],
            rounding: 0,
        };
    },
    computed: { 
        chicken() {
            return this.chickens.reduce((total, item) => total + item.quantity, 0)
        },
        kg() {
            return this.kgs.reduce((total, item) => total + item.quantity, 0)
        },
        boxes() {
            return this.boxesT.reduce((total, item) => total + item.quantity, 0)
        },
        total() {
            return this.amounts.reduce((total, item) => total + item.quantity, 0)
        },
        amount() {
            return this.total + this.rounding;
        },
    },
    methods: {
        add(item) {
            this.items.push(item);
            this.chickens.push({quantity: 1});
            this.kgs.push({quantity: 1});
            this.boxesT.push({quantity: 1});
            this.amounts.push({quantity: item.price});
        },
        remove(index) {
            this.items.splice(index, 1);
            this.chickens.splice(index, 1);
            this.kgs.splice(index, 1);
            this.boxesT.splice(index, 1);
            this.amounts.splice(index, 1);
        },
        reset() {
            this.items = [];
            this.chickens = [];
            this.kgs = [];
            this.boxesT = [];
            this.amounts = [];
        },
        update(index, value, type) {
            if(type == 'q') this.chickens[index].quantity = value;
            if(type == 'k') this.kgs[index].quantity = value;
            if(type == 'b') this.boxesT[index].quantity = value;
            if(type == 't') this.amounts[index].quantity = value;
        },
    },
    created() {
        this.$root.$on('add-to-list', (item) => this.add(item));
        this.$root.$on('remove-from-list', (index) => this.remove(index));
        this.$root.$on('update-item', (data) => this.update(data[0], data[1], data[2]));
        this.$root.$on('reset', () => this.reset());

        if (this.stored) {
            for (var i = this.stored.length - 1; i >= 0; i--) {
                let item = this.stored[i];
                this.items.push(item);
                this.chickens.push({quantity: item.quantity});
                this.kgs.push({quantity: item.kg});
                this.boxesT.push({quantity: item.boxes});
                this.amounts.push({quantity: item.quantity * item.price});
            }
        }
    }
};
</script>
