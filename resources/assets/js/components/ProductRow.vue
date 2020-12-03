<template lang="html">
    <tr>
        <td>{{ index + 1 }}</td>
        <td>
            <div class="form-group">
                <select class="form-control" name="names[]" v-model="product">
                    <option value="" selected>Producto</option>
                    <option v-for="(product, index) in products" :value="product">
                        {{ product.name }}
                    </option>
                </select>
            </div>
            <input type="hidden" name="types[]" :value="product.id">
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
            product: '',
            quantity: 0,
            price: 0,
            products: []
        };
    },
    props: ['item', 'pricetype', 'index'],
    watch: {
        product: function (val, oldVal) {
            if(this.item.pricetype == '23') {
                this.price = this.product.price;
            } else {
                this.price = this.product.price[eval(this.item.pricetype)];
            }
        },
        pricetype: function (val) {
            this.fetch()
        }
    },
    methods: {
        fetch() {
            let isRange = this.item.pricetype != '23' ? '1': '0';

            axios.get('/products/' + isRange).then(response => {
                this.products = response.data;
            });
        }
    },
    created() {
        this.fetch()
    },
    updated() {
        this.fetch()
    },
};
</script>
