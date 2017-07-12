<template lang="html">
    <tr>
        <td>
            {{ num }}
        </td>
        <td>
            <input type="number" name="quantity[]" min="0" step="0.1" v-model="quantity" @change="saveTotal">
        </td>
        <td>
            {{ products[product_id - 1].unity }}
        </td>
        <td>
            <select name="material[]" v-model="product_id" @change="saveTotal">
                <option v-for="product in products" :value="product.id">
                    {{ product.name }}
                </option>
            </select>
        </td>
        <td>
            $ {{ products[product_id - 1].price }}
        </td>
        <td>
            <input type="hidden" name="total[]" :value="products[product_id - 1].price * quantity">
            $ {{ products[product_id - 1].price * quantity }}
        </td>
    </tr>
</template>

<script>
export default {
    data() {
        return {
            product_id: 1,
            quantity: 0,
            total: 0,
        };
    },
    props: ['products', 'num'],
    methods: {
        saveTotal() {
            this.total = this.products[this.product_id - 1].price * this.quantity;
            this.$emit('subtotal', this.total, this.num);
        }
    },
}
</script>
