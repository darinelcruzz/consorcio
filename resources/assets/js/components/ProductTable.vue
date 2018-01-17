<template lang="html">
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th v-for="head in header" :style="head.width" align="center">{{ head.name }}</th>
                </tr>
            </thead>
            <tbody>
                <product-row :products="products" :pricetype="pricetype" :num="1"></product-row>
                <product-row :products="products" :pricetype="pricetype" :num="2"></product-row>
                <product-row :products="products" :pricetype="pricetype" :num="3"></product-row>
                <product-row :products="products" :pricetype="pricetype" :num="4"></product-row>
                <product-row :products="products" :pricetype="pricetype" :num="5"></product-row>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    data() {
        return {
            header: [
                { name:'#', width: 'width: 5%' },
                { name:'Producto', width: 'width: 35%' },
                { name:'Precio', width: 'width: 15%' },
                { name:'Cantidad', width: 'width: 15%' },
                { name:'Kg', width: 'width: 15%' },
                { name:'Cajas', width: 'width: 15%' },
            ],
            products: [],
        };
    },
    props: ['pricetype'],

    created() {
        axios.get('/products').then(response => {
            this.products = response.data;
        });
    }
}
</script>
