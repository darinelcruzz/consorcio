<template>
	<tr>
        <td>
            {{ sale.folio }}
            <a v-if="sale.type == 'Procesado'" :href="route + '/' + sale.id">
                <i class="fa fa-eye"></i>
            </a>
        </td>
        <td>{{ sale.date }}</td>
        <td>
            <div v-if="sale.client.name">
                <a :href="'/clientes/' + sale.client.id">{{ sale.client.name }}</a>
                <a v-if="admin" :href="route + '/editar/' + sale.id">
                    <i class="fa fa-pencil"></i>
                </a>
            </div>
        </td>
        <td>{{ sale.quantity }}</td>
        <td>{{ sale.kg }}</td>
        <td>{{ sale.pricer.name }}</td>
        <td>{{ sale.amount }}</td>
        <td>{{ sale.credit ? sale.days + ' días': 'NO'}}</td>
        <td>
            <label :class="['label',  'label-' + statusColor]">{{ sale.status }}</label>
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
				statusColor: 'default',
			}
		},
		methods: {
			setStatusColor() {
				this.statusColor = this.colors[this.sale.status]
			}
		},
		created() {
			this.setStatusColor()
		}
	};
</script>