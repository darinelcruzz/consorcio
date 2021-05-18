<template lang="html">
    <div v-if="client" :class="['small-box', color]">
        <div class="inner">
            <h3>{{ client.name }}</h3>
            <p>{{ client.address }}</p>
            <h4 v-if="client.credit" align="right">
                Saldo:&nbsp;$ {{ client.balance }}&nbsp;&nbsp;&nbsp;
                Máximas:{{ client.notes }}&nbsp;&nbsp;&nbsp;
                En deuda:&nbsp;{{ client.unpaid }}
            </h4>
        </div>
        <div class="icon">
            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            color: 'bg-green',
            client: null
        };
    },
    props: ['cid'],
    watch: {
        client: function (val, oldVal) {
            if (this.client.unpaid >= this.client.notes && this.client.notes > 0) {
              this.color = 'bg-red';
            } else {
              this.color = 'bg-green';
            }
        }
    },
    created() {        
        this.$root.$on('pick', (client) => {
            this.client = client
        })
    }
}
</script>
