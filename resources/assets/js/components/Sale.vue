<template>
	<tr>
        <td>
            {{ sale.folio }}
            <div v-if="sale.type == 'procesado'">
                <a :href="route.show">
                    <i class="fa fa-eye"></i>
                </a>
            </div>
        </td>
        <td>{{ sale.shortDate }}</td>
        <td>
            <div v-if="sale.client.name">
                <a :href="route.client">{{ sale.client.name }}</a>
                <div v-if="admin">
                    <a :href="route.edit">
                        <i class="fa fa-pencil"></i>
                    </a>
                </div>
            </div>
        </td>
        <td>{{ sale.quantity }}</td>
        <td>{{ sale.kg }}</td>
        <td>{{ sale.price.name }}</td>
        <td>{{ sale.niceAmount }}</td>
        <td>{{ sale.credit ? "sale.days" + " días": 'NO'}}</td>
        <td>
            <label :class="['label',  'label-' + sale.statusColor]">{{ sale.status }}</label>
        </td>
        <td>{{ sale.observations }}</td>
    </tr>
</template>

<script>
	export default {
		props: ['sale', 'admin', 'route'],
		data() {
			return {
				
			}
		}
	};
</script>