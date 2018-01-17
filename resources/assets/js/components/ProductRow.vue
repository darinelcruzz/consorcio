<template lang="html">
    <tr>
        <td>
            {{ num }}
        </td>
        <td>
            <div class="form-group">
                <select class="form-control" name="types[]" v-model="product_id">
                    <option value="3" selected>Producto</option>
                    <option v-for="product in products" :value="product.id">
                        {{ product.name }}
                    </option>
                </select>
            </div>
        </td>

        <td>
            <input type="hidden" name="prices[]" :value="price">
            <span class="pull-right">$ {{ price }}</span>
        </td>

        <td align="center">
            <div class="form-group">
                <input class="form-control" type="number" name="quantities[]" min="0" step="0.1"
                    style="width:85px;">
            </div>
        </td>

        <td align="center">
            <div class="form-group">
                <input class="form-control" type="number" name="kgs[]" min="0" step="0.1"
                    style="width:85px;">
            </div>
        </td>

        <td>
            <input class="form-control" type="number" name="packages[]" min="0" step="0.1"
                style="width:85px;">
        </td>

    </tr>
</template>

<script>
export default {
    data() {
        return {
            product_id: 3,
            quantity: 0,
            total: 0,
            priceId: '',
            price: 0
        };
    },
    props: ['products', 'num', 'pricetype'],
    methods: {
    },
    watch: {
        pricetype: function (val, oldVal) {
          this.priceId = val;
        },
        product_id: function (val, oldVal) {
            if(val > 9) {
                this.price = this.products[val - 4].price;
            } else {
                this.price = this.products[val - 4].price[eval(this.priceId)];
            }
        },
    },
    created() {
        this.priceId = this.pricetype;
        this.price = this.products[this.product_id - 4].price;
    }
}
</script>
