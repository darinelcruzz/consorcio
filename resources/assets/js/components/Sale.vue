<template>
	<tr>
        <td>
            <b>{{ sale.series == null ? 'B': sale.series }}</b>{{ ("00000" + sale.folio).slice(-5) }}
            <a v-if="sale.type == 'Procesado'" :href="route + '/' + sale.id">
                <i class="fa fa-eye"></i>
            </a>
        </td>
        <td>{{ sale.date }}</td>
        <td>
            <div v-if="sale.status != 'cancelada'">
                <a :href="'/clientes/' + sale.client.id">{{ sale.client.name }}</a>
                <a v-if="admin" :href="'/clientes/editar/' + sale.client.id">
                    <i class="fa fa-pencil"></i>
                </a>
            </div>
            <div v-else>
                <em>N o &nbsp; &nbsp; a p l i c a</em>
            </div>
        </td>
        <td>{{ sale.quantity }}</td>
        <td>{{ sale.kg }}</td>
        <td>{{ sale.price ? sale.pricer.name: '' }}</td>
        <td>{{ sale.amount }}</td>
        <td>{{ sale.credit ? sale.days + ' días': 'NO'}}</td>
        <td>
            <label :class="'label label-' + colors[sale.status]">{{ sale.status }}</label>
        </td>
        <td>{{ sale.observations }}</td>
    </tr>
</template>

<script>
	export default {
		props: ['sale', 'admin', 'route'],
		data() {
			return {
				colors: {'vencida': 'danger', 'cancelada': 'default', 'pagado': 'success', 'credito': 'warning'},
			}
		},
	};
</script>