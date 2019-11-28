<template>
	<div id="sales_table">
        <div class="row">
            <div class="col-md-6">
                <div class="btn-group">
                    <button @click="fetch(pagination.first)" :disabled="!pagination.first" :class="'btn btn-' + color + ' btn-sm'">
                        <i class="fa fa-angle-double-left"></i>
                    </button>
                    <button @click="fetch(pagination.prev)" :disabled="!pagination.prev" :class="'btn btn-' + color + ' btn-sm'">
                        <i class="fa fa-angle-left"></i>
                    </button>
                    <button class="btn btn-default btn-sm">Página {{ pagination.current }} de {{ pagination.last_page }}</button>
                    <button @click="fetch(pagination.next)" :disabled="!pagination.next" :class="'btn btn-' + color + ' btn-sm'">
                        <i class="fa fa-angle-right"></i>
                    </button>
                    <button @click="fetch(pagination.last)" :disabled="!pagination.last" :class="'btn btn-' + color + ' btn-sm'">
                        <i class="fa fa-angle-double-right"></i>
                    </button>
                </div>
            </div>
            
            <div class="col-md-3 pull-right">
                <div class="input-group input-group-sm">
                    <input type="text" v-model="keyword" class="form-control" @change="fetch()">
                    <span class="input-group-btn">
                      <button type="button" :class="'btn btn-' + color + ' btn-flat'">
                          <i class="fa fa-search"></i>
                      </button>
                    </span>
                </div>
            </div>
        </div>
        <br>
        <div class="table-responsive">
            <table class="table table-striped table-bordered" style="height: 200px">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>
                            <i class="fa fa-cogs"></i>
                        </th>
                        <th>Nombre</th>
                        <th>Teléfono(s)</th>
                        <th>Dirección</th>
                        <th>Productos</th>
                        <th>Crédito</th>
                    </tr>
                </thead>

                <tbody>
                    <tr v-for="(client, index) in clients" :key="index" is="client" :client="client" :auth="auth"></tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
	export default {
		props: {
            color: String,
            auth: {
                type: String,
                default: '',
            }
        },
		data() {
			return {
                clients: [],
				pagination: {},
                keyword: '',
			}
		},
		methods: {
			fetch(page_url) {
                page_url = page_url || '/api/clients/all/' + this.keyword
                
                console.log(page_url);

                axios.get(page_url).then((response) => {
                    var clients = response.data.data.map((item) => {
                        return item
                    })

                    this.clients = clients
                    this.pagination = this.paginate(response.data)
                })
            },
            paginate(data) {
                return {
                    current: data.current_page,
                    last_page: data.last_page,
                    next: data.next_page_url,
                    prev: data.prev_page_url,
                    last: data.last_page_url,
                    first: data.first_page_url,
                }
            }
		},
		created() {
			this.fetch()
		}
	};
</script>