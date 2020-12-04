<template lang="html">
    <tr>
        <td><a @click="remove" style="color:red;"><i class="fa fa-times"></i></a></td>
        <td>
            {{ item.name }}
            <input :name="'items[' + index + '][product_id]'" type="hidden" :value="item.id">
        </td>
        <td>
            {{ item.price.toFixed(2) }}
            <input :name="'items[' + index + '][price]'" type="hidden" :value="item.price">
        </td>
        <td>
            <input :name="'items[' + index + '][quantity]'" type="number" step="1" min="1" class="form-control" v-model.number="quantity">
        </td>
        <td>
            <input :name="'items[' + index + '][kg]'" type="number" step="0.01" min="0.01" class="form-control" v-model.number="kg">
        </td>
        <td>
            <input :name="'items[' + index + '][boxes]'" type="number" step="1" min="1" class="form-control" v-model.number="boxes">
        </td>
        <td style="text-align: right;">
            {{ total.toFixed(2) }}
        </td>
    </tr>
</template>

<script>
export default {
    data() {
        return {
            quantity: 1,
            boxes: 1,
            kg: 1,
        };
    },
    props: ['item', 'index'],
    computed: {
        total() {
            return this.item.price * this.quantity;
        }
    },
    watch: {
        total(newVal) {
            this.$root.$emit('update-total', [this.index, newVal]);
        },
        quantity(newVal) {
            this.$root.$emit('update-quantity', [this.index, newVal]);
        },
        kg(newVal) {
            this.$root.$emit('update-kg', [this.index, newVal]);
        },
        boxes(newVal) {
            this.$root.$emit('update-boxes', [this.index, newVal]);
        }
    },
    methods: {
        remove() {
            this.$root.$emit('remove-from-list', this.index)
        }
    },
};
</script>
