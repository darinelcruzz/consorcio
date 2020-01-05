<template>
	<tr>
        <td>
            <b>{{ sale.series }}</b>{{ ("00000" + sale.folio).slice(-5) }}
        </td>
        <td>{{ sale.date }}</td>
        <td>{{ sale.kg }}</td>
        <td>{{ sale.price ? sale.pricer.name: '' }}</td>
        <td>$ {{ sale.amount.toFixed(2) }}</td>
        <td></td>
        <td>
            <!-- {!! Form::open(['method' => 'POST', 'route' => 'deposit.store']) !!} -->

            <div class="input-group input-group-sm">
                <input type="hidden" name="type" :value="product">
                <input type="hidden" name="sale_id" :value="sale.id">
                <input type="hidden" name="user" value="2">
                <input type="number" class="form-control" name="amount" min="0.01" value="0" step="0.01">
                <span class="input-group-btn">
                  <button type="submit" class="btn btn-success btn-flat btn-xs">
                      <i class="fa fa-plus"></i>
                  </button>
                </span>
            </div>
        </td>
        <td>
            <label :class="'label label-' + colors[sale.status]">{{ sale.status }}</label>
        </td>
    </tr>
</template>

<script>
	export default {
		props: ['sale', 'product'],
		data() {
			return {
				colors: {'vencida': 'danger', 'cancelada': 'default', 'pagado': 'success', 'credito': 'warning'},
			}
		},
	};
</script>