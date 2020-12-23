<template>
	<div id="shippings_table">
        <div class="row">
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
            <div class="col-md-4 pull-right">
                <div class="input-group input-group-sm">
                    <input type="text" v-model="keyword" class="form-control">
                    <span class="input-group-btn">
                      <button type="button" :class="'btn btn-warning btn-flat'">
                          <i class="fa fa-search"></i>
                      </button>
                    </span>
                </div>
            </div>
        </div>
        <br>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><i class="fa fa-cogs"></i></th>
                        <th>Fecha</th>
                        <th>Remisión</th>
                        <th>Proveedor</th>
                        <th style="text-align: center;">Producto</th>
                        <th style="text-align: center;">Cantidad</th>
                        <th>Precio</th>
                        <th>Importe</th>
                        <th style="width: 25%">Observaciones</th>
                    </tr>
                </thead>

                <tbody>
                    <tr v-for="(shipping, index) in shippings" :key="index" is="shipping" :shipping="shipping"></tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
	export default {
		data() {
			return {
                shippings: [],
				pagination: {},
                keyword: '',
                btnClass: 'btn btn-warning btn-sm',
			}
		},
        computed: {
            pageUrl() {
                return '/api/shippings/' + this.keyword;
            },
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
                    this.shippings = response.data.data.map((results) => results)

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
