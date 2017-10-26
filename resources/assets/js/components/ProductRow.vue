<template lang="html">
    <tr>
        <td>
            {{ num }}
        </td>
        <td>
            <div class="form-group">
                <select class="form-control" name="types[]" v-model="product_id" @change="saveTotal">
                    <option value="" selected>Seleccione un producto</option>
                    <option v-for="product in products" :value="product.id">
                        {{ product.name }}
                    </option>
                </select>
            </div>
        </td>
        <td align="center">
            <div class="form-group">
                <input class="form-control" type="number" name="numbers[]" min="0" step="0.1" v-model="quantity"
                    @change="saveTotal" style="width:85px;">
            </div>
        </td>

        <td>
            {{ price }}
        </td>

        <td>
            <input type="hidden" name="total[]" :value="total">
            {{ total }}
        </td>

    </tr>
</template>

<script>
export default {
    data() {
        return {
            product_id: 4,
            quantity: 0,
            total: 0,
            priceId: '',
            price: 0
        };
    },
    props: ['products', 'num', 'pricetype'],
    methods: {
        saveTotal() {
            this.total = this.price * this.quantity;
            this.$emit('subtotal', this.total, this.num);
        }
    },
    watch: {
        pricetype: function (val, oldVal) {
          this.priceId = val;
        },
        product_id: function (val, oldVal) {
            if(val > 8) {
                this.price = this.products[val - 4].price;
            } else {
                this.price = this.products[val - 4].price[eval(this.priceId)];
            }

        },
    },
    filters: {
        currency: function (value) {
          return '$ ' + value;
        }
    },
    created() {
        this.priceId = this.pricetype;
        this.price = this.products[this.product_id - 4].price;
    }
}
</script>
