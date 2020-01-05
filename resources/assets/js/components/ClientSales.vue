<template>
	<div id="sales_table">
        <div class="row">
            <div class="col-md-2 pull-right">
                <div class="input-group input-group-sm">
                    <input type="text" v-model="keyword" class="form-control" @change="search">
                    <span class="input-group-btn">
                      <button type="button" :class="'btn btn-' + color + ' btn-flat'">
                          <i class="fa fa-search"></i>
                      </button>
                    </span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="btn-group">
                    <button @click="fetchSales(pagination.first_page_url)" :disabled="!pagination.first_page_url" :class="'btn btn-' + color + ' btn-sm'">
                        <i class="fa fa-angle-double-left"></i>
                    </button>
                    <button @click="fetchSales(pagination.prev_page_url)" :disabled="!pagination.prev_page_url" :class="'btn btn-' + color + ' btn-sm'">
                        <i class="fa fa-angle-left"></i>
                    </button>
                    <button class="btn btn-default btn-sm">Página {{ pagination.current_page }} de {{ pagination.last_page }}</button>
                    <button @click="fetchSales(pagination.next_page_url)" :disabled="!pagination.next_page_url" :class="'btn btn-' + color + ' btn-sm'">
                        <i class="fa fa-angle-right"></i>
                    </button>
                    <button @click="fetchSales(pagination.last_page_url)" :disabled="!pagination.last_page_url" :class="'btn btn-' + color + ' btn-sm'">
                        <i class="fa fa-angle-double-right"></i>
                    </button>
                </div>
            </div>
        </div>
        <br>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Folio</th>
                    <th>Fecha</th>
                    <th>Kg</th>
                    <th>Precio</th>
                    <th>Importe</th>
                    <th>Por pagar</th>
                    <th>Abonar</th>
                    <th>Estado</th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="(sale, index) in sales" :key="index" is="client-sale" :sale="sale" :product="types[type]"></tr>
            </tbody>
        </table>
    </div>
</template>

<script>
	export default {
		props: ['client', 'type', 'color'],
		data() {
			return {
                sales: [],
				pagination: {},
                keyword: '',
                types: {'Vivo': 'alive', 'Fresco': 'fresh', 'Cerdo': 'pork', 'Procesado': 'processed'},
			}
		},
		methods: {
			fetchSales(page_url) {
                page_url = page_url || '/api/clients/' + this.client + '/sales/' + this.types[this.type]
                console.log("page_url", page_url);
                axios.get(page_url)
                    .then((response) => {
                        var salesReady = response.data.data.map((sale) => {
                            sale.type = this.type;
                            return sale
                        })

                        var pagination = {
                            current_page: response.data.current_page,
                            last_page: response.data.last_page,
                            next_page_url: response.data.next_page_url,
                            prev_page_url: response.data.prev_page_url,
                            last_page_url: response.data.last_page_url,
                            first_page_url: response.data.first_page_url,
                        }

                        this.sales = salesReady
                        this.pagination = pagination
                    })
            },
            searchSales(page_url, keyword) {
                page_url = '/api/sales/' + this.types[this.type] + '/' + keyword
                console.log("page_url", page_url);
                axios.get(page_url)
                    .then((response) => {
                        var salesReady = response.data.data.map((sale) => {
                            sale.type = this.type;
                            return sale
                        })

                        var pagination = {
                            current_page: response.data.current_page,
                            last_page: response.data.last_page,
                            next_page_url: response.data.next_page_url,
                            prev_page_url: response.data.prev_page_url,
                            last_page_url: response.data.last_page_url,
                            first_page_url: response.data.first_page_url,
                        }

                        this.sales = salesReady
                        this.pagination = pagination
                    })
            },
            search() {
                this.searchSales(this.pagination.current_page, this.keyword)
            }
		},
		created() {
			this.fetchSales()
		}
	};
</script>