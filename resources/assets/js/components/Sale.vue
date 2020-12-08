<template>
	<tr>
        <td>
            <b>{{ sale.series }}</b>{{ ("00000" + sale.folio).slice(-5) }}
        </td>
        <td>
            <dropdown icon="cogs" :color="colors[type]">
                <ddi v-if="type == 'procesado'" icon="eye" :to="type + '/' + sale.id">Ver productos</ddi>
                <ddi v-if="admin" icon="pencil" :to="'editar/' + type + '/' + sale.id">Editar</ddi>
            </dropdown>
        </td>
        <td>{{ sale.date }}</td>
        <td>
            <div v-if="sale.status != 'cancelada'">
                <a :href="'/clientes/' + sale.client.id">{{ sale.client.name }}</a>
            </div>
            <div v-else>
                <em>N o &nbsp; &nbsp; a p l i c a</em>
            </div>
        </td>
        <td style="text-align: center;">{{ sale.quantity || '/' }}</td>
        <td style="text-align: center;">{{ sale.kg || '/' }}</td>
        <td style="text-align: center;">{{ sale.price ? sale.pricer.name: '/' }}</td>
        <td style="text-align: right;">{{ (Number(sale.amount)).toFixed(2) }}</td>
        <td style="text-align: center;">{{ sale.credit ? sale.days + ' días': 'NO'}}</td>
        <td style="text-align: center;">
            <label :class="'label label-' + labels[sale.status]">{{ sale.status.toUpperCase() }}</label>
        </td>
        <td>{{ sale.observations }}</td>
    </tr>
</template>

<script>
	export default {
		props: ['sale', 'admin', 'type'],
		data() {
			return {
				labels: {'vencida': 'danger', 'cancelada': 'default', 'pagado': 'success', 'credito': 'warning'},
                colors: {'vivo': 'primary', 'fresco': 'warning', 'procesado': 'success', 'cerdo': 'baby'},
			}
		},
	};
</script>
