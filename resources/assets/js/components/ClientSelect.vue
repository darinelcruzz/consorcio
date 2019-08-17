<template>
	<div id="client_select">

	    <div class="form-group">
          	<label for="client_id" class="control-label">
		        <b>Cliente</b>
		    </label>

		    <div class="input-group">
		        <span class="input-group-addon"><i class="fa fa-user"></i></span>

		        <select name="client_id" v-model="client" @change="send"  class="form-control">
					<option value="" selected>Elige un cliente</option>
					<option v-for="(client, index) in clients" :key="index" :value="client">{{ client.name }}</option>
				</select>
		    </div>
        </div>

		<input type="hidden" name="client_id" :value="client.id">
	</div>
</template>

<script>
	export default {
	    data() {
	        return {
	            clients: [],
	            client: ''
	        };
	    },
	    props: ['product'],
	    methods: {
	    	send() {
	    		this.$root.$emit('pick', this.client)
	    	}
	    },
	    created() {
	        axios.get('/api/clients/' + this.product).then(response => {
	            this.clients = response.data
	        });
	    }
	}
</script>