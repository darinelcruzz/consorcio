<template>
	<tr>
        <td>
            <b>{{ sale.series }}</b>{{ ("00000" + sale.folio).slice(-5) }}
        </td>
        <td>{{ sale.date }}</td>
        <td>{{ sale.kg }}</td>
        <td>{{ sale.price ? sale.pricer.name: '' }}</td>
        <td>$ {{ sale.amount.toFixed(2) }}</td>
        <td>$ {{ debt.toFixed(2) }}</td>
        <td>
            <form method="post" action="/credito/abonar">
                <input type="hidden" name="type" :value="names[product]">
                <input type="hidden" name="sale_id" :value="sale.id">
                <input type="hidden" name="user" value="Valeria Gordillo">
                <slot></slot>
                <div v-if="debt > 0" class="input-group input-group-sm">
                    <input type="number" class="form-control" name="amount" min="0.01" value="0" step="0.01">
                    <span class="input-group-btn">
                      <button type="submit" class="btn btn-success btn-flat btn-xs">
                          <i class="fa fa-plus"></i>
                      </button>
                    </span>
                </div>
            </form>
        </td>
        <td>
            <label :class="'label label-' + colors[sale.status]">{{ sale.status.toUpperCase() }}</label>
        </td>
        <td>
            <a :href="'/credito/detalles/' + names[product] + '/' + sale.id + '/' + sale.amount" class="btn btn-xs btn-info">
                <i class="fa fa-eye"></i>
            </a>
        </td>
    </tr>
</template>

<script>
	export default {
		props: ['sale', 'product'],
		data() {
			return {
				colors: {'vencida': 'danger', 'cancelada': 'default', 'pagado': 'success', 'credito': 'warning'},
                names: {'alive': 'vivo', 'fresh': 'fresco', 'pork': 'cerdo', 'processed': 'procesado'},
			}
		},
        computed: {
            debt() {
                return this.sale.amount - this.sale.deposits.reduce((total, deposit) => {
                    if (this.names[this.product] == deposit.type) {
                        return total + deposit.amount
                    }

                    return total + 0
                }, 0)
            }
        },
	};
</script>