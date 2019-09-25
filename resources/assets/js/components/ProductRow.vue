<template lang="html">
    <tr>
        <td>
            {{ num }}
        </td>
        <td>
            <div class="form-group">
                <select class="form-control" name="names[]" v-model="product_id">
                    <option value="3" selected>Producto</option>
                    <option v-for="(product, index) in products" :value="index">
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
            product_id: 0,
            quantity: 0,
            price: 0,
            products: []
        };
    },
    props: ['num', 'pricetype'],
    computed: {
        // products() {
        //     if (this.pricetype == '23') {
        //         return this.products.slice(6)
        //     }

        //     return this.products.slice(0, 6)
        // },
        type() {
            return this.products[this.product_id].id
        }
    },
    watch: {
        product_id: function (val, oldVal) {
            if(this.pricetype == '23') {
                this.price = this.products[val].price;
            } else {
                this.price = this.products[val].price[eval(this.pricetype)];
            }
        },
    },
    methods: {
        fetch() {
            let isRange = this.pricetype != '23' ? '1': '0';

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
    }
};
</script>
