<template lang="html">
    <div class="table-responsive">

        <div class="row">
            <div class="col-md-4 pull-right">
                <div class="input-group input-group-sm">
                    <input type="text" v-model="keyword" class="form-control" @keyup.enter="search">
                    <span class="input-group-btn">
                      <button type="button" :class="'btn btn-warning btn-flat'">
                          <i class="fa fa-search"></i>
                      </button>
                    </span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="btn-group">
                    <button @click="fetchDeposits(pagination.first_page_url)" :disabled="!pagination.first_page_url" :class="'btn btn-warning btn-sm'">
                        <i class="fa fa-angle-double-left"></i>
                    </button>
                    <button @click="fetchDeposits(pagination.prev_page_url)" :disabled="!pagination.prev_page_url" :class="'btn btn-warning btn-sm'">
                        <i class="fa fa-angle-left"></i>
                    </button>
                    <button class="btn btn-default btn-sm">Página {{ pagination.current_page }} de {{ pagination.last_page }}</button>
                    <button @click="fetchDeposits(pagination.next_page_url)" :disabled="!pagination.next_page_url" :class="'btn btn-warning btn-sm'">
                        <i class="fa fa-angle-right"></i>
                    </button>
                    <button @click="fetchDeposits(pagination.last_page_url)" :disabled="!pagination.last_page_url" :class="'btn btn-warning btn-sm'">
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
                    <th>Producto</th>
                    <th>Importe</th>
                    <th>Fecha</th>
                    <th>Usuario</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(deposit, index) in deposits">
                    <td>{{ deposit.sale_id }}</td>
                    <td style="text-align: center;">
                        <div v-if="deposit.type == 'procesado'">
                            <span class="badge bg-green"><em>procesado</em></span>
                        </div>
                        <div v-if="deposit.type == 'vivo'">
                           <span class="badge bg-blue"><em>vivo</em></span> 
                        </div>
                        <div v-if="deposit.type == 'fresco'">
                           <span class="badge bg-yellow"><em>fresco</em></span> 
                        </div>
                        <div v-if="deposit.type == 'cerdo'">
                            <span class="badge" style="background-color: #EE76A0;"><em>cerdo</em></span>
                        </div>
                    </td>
                    <td>$ {{ Number(deposit.amount).toFixed(2) }}</td>
                    <td>{{ deposit.created_at }}</td>
                    <td>{{ deposit.user }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    data() {
        return {
            deposits: [],
            pagination: {},
            keyword: ''
        };
    },

    methods: {
        fetchDeposits(page_url, keyword) {
            keyword = keyword || ''
            axios.get(page_url + keyword)
                .then((response) => {
                    var depositsReady = response.data.data.map((product) => {
                        return product
                    })

                    var pagination = {
                        current_page: response.data.current_page,
                        last_page: response.data.last_page,
                        next_page_url: response.data.next_page_url,
                        prev_page_url: response.data.prev_page_url,
                        last_page_url: response.data.last_page_url,
                        first_page_url: response.data.first_page_url,
                    }

                    this.deposits = depositsReady
                    this.pagination = pagination
                })
        },
        search() {
            this.fetchDeposits('/deposits/', this.keyword)
        }
    },
    created() {
        this.fetchDeposits('/deposits')
    }
}
</script>