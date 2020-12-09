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
                <tr v-for="(item, index) in items">
                    <td v-if="item.enable"><a @click="add(item, index)"><i class="fa fa-plus"></i></a></td>
                    <td v-else><span style="color: gray;"><i class="fa fa-plus"></i></span></td>
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
        type(newVal, oldVal) {
            this.fetch();
            if (newVal == 23 || newVal <= 12 && oldVal == 23) {
                this.$root.$emit('reset');
            } else {
                console.log(newVal, newVal + 32)
                this.$root.$emit('update-price', newVal + 32);
            }
        }
    },
    methods: {
        add(item, index) {
            this.items[index].enable = false;
            item.index = index;
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
        this.$root.$on('enable', (index) => this.items[index].enable = true)
    }
};
</script>
