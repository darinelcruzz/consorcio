<template>
	<div id="sales_table">
        <div class="row">
            <div class="col-md-2 pull-right">
                <div class="input-group input-group-sm">
                    <input type="text" v-model="keyword" class="form-control">
                    <span class="input-group-btn">
                      <button type="button" :class="'btn btn-' + color + ' btn-flat'">
                          <i class="fa fa-search"></i>
                      </button>
                    </span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="btn-group">
                    <button @click="fetch(pagination.first_page_url)" :disabled="!pagination.first_page_url" :class="btnClass">
                        <i class="fa fa-angle-double-left"></i>
                    </button>
                    <button @click="fetch(pagination.prev_page_url)" :disabled="!pagination.prev_page_url" :class="btnClass">
                        <i class="fa fa-angle-left"></i>
                    </button>
                    <button class="btn btn-default btn-sm">Página {{ pagination.current_page }} de {{ pagination.last_page }}</button>
                    <button @click="fetch(pagination.next_page_url)" :disabled="!pagination.next_page_url" :class="btnClass">
                        <i class="fa fa-angle-right"></i>
                    </button>
                    <button @click="fetch(pagination.last_page_url)" :disabled="!pagination.last_page_url" :class="btnClass">
                        <i class="fa fa-angle-double-right"></i>
                    </button>
                </div>
            </div>
        </div>
        <br>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Folio</th>
                        <th><i class="fa fa-cogs"></i></th>
                        <th>Fecha</th>
                        <th>Cliente</th>
                        <th>Cantidad</th>
                        <th style="text-align: center;">KG</th>
                        <th style="text-align: center;">Precio</th>
                        <th>Importe</th>
                        <th>Crédito</th>
                        <th>Estado</th>
                        <th>Observaciones</th>
                    </tr>
                </thead>

                <tbody>
                    <tr v-for="(sale, index) in sales" :key="index" is="sale" :sale="sale" :admin="admin" :type="type"></tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
	export default {
		props: ['type', 'admin', 'color'],
		data() {
			return {
                sales: [],
				pagination: {},
                keyword: '',
                types: {'vivo': 'alive', 'fresco': 'fresh', 'cerdo': 'pork', 'procesado': 'processed'},
			}
		},
        computed: {
            pageUrl() {
                return '/api/sales/' + this.types[this.type] + '/' + this.keyword;
            },
            btnClass() {
                return 'btn btn-' + this.color + ' btn-sm';
            }
        },
        watch: {
            keyword(value) {
                this.fetch();
            }
        },
		methods: {
            fetch(page_url) {
                page_url = page_url || this.pageUrl;
                console.log(page_url);
                axios.get(page_url).then((response) => {
                    this.sales = response.data.data.map((product) => product)

                    this.pagination = {
                        current_page: response.data.current_page,
                        last_page: response.data.last_page,
                        next_page_url: response.data.next_page_url,
                        prev_page_url: response.data.prev_page_url,
                        last_page_url: response.data.last_page_url,
                        first_page_url: response.data.first_page_url,
                    }
                })
            },
		},
		created() {
			this.fetch()
		}
	};
</script>
