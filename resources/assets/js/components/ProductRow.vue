<template lang="html">
    <tr>
        <td><a @click="remove" style="color:red;"><i class="fa fa-times"></i></a></td>
        <td>
            {{ item.name }}
            <input :name="'items[' + index + '][product_id]'" type="hidden" :value="item.id">
        </td>
        <td v-if="model == 'envio'">
            <input :name="'items[' + index + '][price]'" type="number" step="0.01" min="0.01" class="form-control" v-model.number="price">
        </td>
        <td v-else>
            {{ price.toFixed(2) }}
            <input :name="'items[' + index + '][price]'" type="hidden" :value="item.price">
        </td>
        <td>
            <input :name="'items[' + index + '][quantity]'" type="number" step="1" min="1" class="form-control" v-model.number="quantity">
        </td>
        <td>
            <input :name="'items[' + index + '][kg]'" type="number" step="0.01" min="0.01" class="form-control" v-model.number="kg">
        </td>
        <!-- <td>
            <input :name="'items[' + index + '][boxes]'" type="number" step="1" min="1" class="form-control" v-model.number="boxes">
        </td> -->
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
            price: 1,
        };
    },
    props: ['item', 'index', 'model'],
    computed: {
        total() {
            return this.price * this.kg;
        }
    },
    watch: {
        total(newVal) {
            this.$root.$emit('update-item', [this.index, newVal, 't']);
        },
        quantity(newVal) {
            this.$root.$emit('update-item', [this.index, newVal, 'q']);
        },
        kg(newVal) {
            this.$root.$emit('update-item', [this.index, newVal, 'k']);
        },
        boxes(newVal) {
            this.$root.$emit('update-item', [this.index, newVal, 'b']);
        }
    },
    methods: {
        remove() {
            this.$root.$emit('remove-from-list', this.index);
            this.$root.$emit('enable', this.item.index);
        }
    },
    created() {
        this.$root.$on('update-price', (price) => {
            this.price = price
        });

        if (this.item.quantity) {
            this.quantity = this.item.quantity;
            this.boxes = this.item.boxes;
            this.kg = this.item.kg;
        }

        this.price = this.model == 'envio' ? 0: this.item.price;
    }
};
</script>
