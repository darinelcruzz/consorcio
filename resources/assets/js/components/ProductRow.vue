<template lang="html">
    <tr>
        <td>
            {{ num }}
        </td>
        <td>
            <div class="form-group">
                <select class="form-control" name="names[]" v-model="product_id">
                    <option value="3" selected>Producto</option>
                    <option v-for="(product, index) in products_list" :value="index">
                        {{ product.name }}
                    </option>
                </select>
            </div>
            <input type="hidden" name="types[]" :value="type">
        </td>

        <td>
            <input type="hidden" name="prices[]" :value="price">
            <span class="pull-right">$ {{ price }}</span>
        </td>

        <td align="center">
            <div class="form-group">
                <input class="form-control" type="number" name="quantities[]" min="0" step="0.01"
                    style="width:85px;" v-model="quantity">
            </div>
        </td>

        <td align="center">
            <div class="form-group">
                <input class="form-control" type="number" name="kgs[]" min="0" step="0.01"
                    style="width:85px;">
            </div>
        </td>

        <td>
            <input class="form-control" type="number" name="packages[]" min="0" step="0.01"
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
            price: 0,
        };
    },
    props: ['products', 'num', 'pricetype'],
    computed: {
        products_list() {
            if (this.pricetype == '23') {
                return this.products.slice(6)
            }

            return this.products.slice(0, 6)
        },
        type() {
            return this.products_list[this.product_id].id
        }
    },
    watch: {
        product_id: function (val, oldVal) {
            if(this.pricetype == '23') {
                this.price = this.products_list[val].price;
            } else {
                this.price = this.products_list[val].price[eval(this.pricetype)];
            }
        },
    },
};
</script>
