<template>
	<div class="row">
        <div v-if="client.credit"  class="col-md-6">
            <div class="form-group">
	          	<label for="client_id" class="control-label">
			        <b>Crédito</b>
			    </label>

			    <div class="input-group">
			        <span class="input-group-addon"><i class="fa fa-credit-card-alt"></i></span>

			        <select name="credit" class="form-control">
						<option value="" selected>¿Se vende a crédito?</option>
						<option value="0">No</option>
						<option value="1">Semanal</option>
						<option value="2">Quince días</option>
					</select>
			    </div>
	        </div>
        </div>
        <input v-else type="hidden" name="credit" value="0">
    </div>
</template>

<script>
	export default {
	    data() {
	        return {
	            client: {}
	        };
	    },
	    created() {        
	        this.$root.$on('pick', (client) => {
	            this.client = client
	        })
	    }
	}
</script>