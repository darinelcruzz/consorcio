<template lang="html">
    <div :class="['small-box', color]">
        <div v-if="client > 0" class="inner">
            <h3>{{ clients[client].name }}</h3>
            <p>{{ clients[client].address }}</p>
            <h4 v-if="clients[client].credit" align="right">
                Saldo:&nbsp;$ {{ clients[client].balance }}&nbsp;&nbsp;&nbsp;
                Máximas:{{ clients[client].notes }}&nbsp;&nbsp;&nbsp;
                En deuda:&nbsp;{{ clients[client].unpaid }}
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
            color: 'bg-green'
        };
    },
    props: ['clients', 'client'],
    watch: {
        client: function (val, oldVal) {
          if (this.clients[val].unpaid >= this.clients[val].notes && this.clients[val].notes > 0) {
              this.color = 'bg-red';
          } else {
              this.color = 'bg-green';
          }
        }
    },
}
</script>

<style lang="css">
</style>
