<template>
	<tr>
        <td>{{ shipping.id }}</td>
        <td>
            <dropdown icon="cogs" color="warning">
                <ddi v-if="shipping.product == '20'" icon="eye" :to="'embarques/' + shipping.id">Ver productos</ddi>
                <ddi icon="pencil" :to="'embarques/editar/' + shipping.id">Editar</ddi>
            </dropdown>
        </td>
        <td>{{ shipping.date }}</td>
        <td>{{ shipping.remission }}</td>
        <td>{{ provider }}</td>
        <td style="text-align: center;">
            <span v-if="shipping.productr.name == 'Cerdo'" class="badge" style="background-color: #EE76A0;">
                <em><small>CERDO</small></em>
            </span>
            <span v-else :class="'badge bg-' + badgeColors[shipping.product]">
                <em><small>{{ shipping.product >= 20 ? 'PROCESADO' : shipping.productr.name.toUpperCase() }}</small></em>
            </span>
        </td>
        <td style="text-align: center;">{{ shipping.movements.reduce((total, item) => total + item.quantity, 0) }}</td>
        <td style="text-align: center;">{{ shipping.movements.reduce((total, item) => total + item.kg, 0).toFixed(2) }}</td>
        <td style="text-align: center;">{{ formatNumber(shipping.price) }}</td>
        <td style="text-align: right;">{{ formatNumber(shipping.amount) }}</td>
        <td>{{ shipping.observations }}</td>
    </tr>
</template>

<script>
	export default {
		props: ['shipping'],
		data() {
			return {
                badgeColors: {'20': 'green', '3': 'blue', '1': 'fuchsia', '18': 'purple', '23': 'green'},
			}
		},
        computed: {
            provider() {
                return this.shipping.provider.charAt(0).toUpperCase() + this.shipping.provider.slice(1)
            }
        },
        methods: {
            formatNumber(number) {
                let formatter = new Intl.NumberFormat();
                return formatter.format(number);
            }
        }
	};
</script>
