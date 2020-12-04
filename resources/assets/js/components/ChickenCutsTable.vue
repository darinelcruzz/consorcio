<template lang="html">
    <div class="table-responsive">
        <table v-if="items.length > 0" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th><i class="fa fa-plus"></i></th>
                    <th>Producto</th>
                    <th>Precio</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in items">
                    <td>
                        <a @click="add(item)"><i class="fa fa-plus"></i></a>
                    </td>
                    <td>{{ item.name }}</td>
                    <td>{{ item.price.toFixed(2) }}</td>
                </tr>
            </tbody>
        </table>

        <div v-else>
            <code>Seleccione un tipo de precio</code>
        </div>
    </div>
</template>

<script>
export default {
    props: ['type'],
    data() {
        return {
            items: [],
        };
    },
    watch: {
        type(val) {
            this.fetch();
        }
    },
    methods: {
        add(item) {
            this.$root.$emit('add-to-list', item);
        },
        fetch() {
            axios.get('/api/prices/' + this.type).then(response => {
                this.items = response.data
            });
        }
    },
    created() {
        this.fetch();
    }
};
</script>
