<template>
	<tr>
        <td :style=" sales_count == 0 ? 'background-color: #ff1111; color: white;': ''">{{ client.id }}</td>
        <td>
            <dropdown icon="cogs" color="warning">
                <ddi icon="eye" :to="'/clientes/' + client.id">Detalles</ddi>
                <ddi v-if="auth == '1'" icon="edit" :to="'/clientes/editar/' + client.id">Editar</ddi>
            </dropdown>
        </td>
        <td>
            {{ client.name }} <br v-if="client.rfc != null">
            <span style="color: navy">{{ client.rfc }}</span> <br v-if="client.email != null">
            <code>{{ client.email }}</code>
        </td>
        <td>
            {{ client.phone }} <br>
            {{ client.cellphone }}
        </td>
        <td>
            {{ client.address }} <br>
            
        </td>
        <td>{{ products.substring(0, products.length - 2) }}</td>
        <td>{{ credit }}</td>
    </tr>
</template>

<script>
	export default {
		props: {
            client: Object,
            auth: {
                type: String,
                default: '',
            }
        },
        computed: {
            credit() {
                if (this.client.credit == 1) {
                    return this.client.notes + ' notas [' + this.client.days + ' días]'
                } else {
                    return 'No'
                }
            },
            products() {
                let haystack = this.client.products
                let stringp = ''

                if (haystack.includes('vivo')) {
                    stringp += 'Vivo | '
                }
                if (haystack.includes('fresco')) {
                    stringp += 'Fresco | '
                }
                if (haystack.includes('procesado')) {
                    stringp += 'Procesado | '
                }
                if (haystack.includes('cerdo')) {
                    stringp += 'Cerdo | '
                }

                return stringp
            },
            sales_count() {
                return this.client.porksales.length + this.client.freshsales.length + this.client.processedsales.length + this.client.alivesales.length
            }
        }
	};
</script>
