<template lang="html">
    <tr>
        <td>
            {{ num }}
        </td>
        <td>
            <div class="form-group">
                <select class="form-control" name="material[]" v-model="product_id" @change="saveTotal">
                    <option v-for="product in products" :value="product.id">
                        {{ product.name }}
                    </option>
                </select>
            </div>
        </td>
        <td align="center">
            <div class="form-group">
                <input class="form-control" type="number" name="quantity[]" min="0" step="0.1" v-model="quantity"
                    @change="saveTotal" style="width:85px;">
            </div>
        </td>
        <td v-if="products[product_id - 5].unity">
            {{ products[product_id - 5].unity }}
        </td>
        <td>
            {{ products[product_id - 5].price | currency }}
        </td>
        <td>
            <input type="hidden" name="total[]" :value="products[product_id - 5].price * quantity">
            {{ products[product_id - 5].price * quantity | currency }}
        </td>
    </tr>
</template>

<script>
export default {
    data() {
        return {
            product_id: 5,
            quantity: 0,
            total: 0,
        };
    },
    props: ['products', 'num'],
    methods: {
        saveTotal() {
            this.total = this.products[this.product_id - 5].price * this.quantity;
            this.$emit('subtotal', this.total, this.num);
        }
    },
    filters: {
        currency: function (value) {
          return '$ ' + value.toFixed(2);
        }
    },
}
</script>
