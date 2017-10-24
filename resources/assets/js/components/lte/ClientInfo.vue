<template lang="html">
    <div :class="['small-box', color]">
        <div v-if="client > 0" class="inner">
            <h3>{{ clients[client - 1].name }}</h3>
            <p>{{ clients[client - 1].address }}</p>
            <h4 v-if="clients[client - 1].notes > 0" align="right">
                Saldo:&nbsp;$ {{ clients[client - 1].balance }}&nbsp;&nbsp;&nbsp;
                Máximas:{{ clients[client - 1].notes }}&nbsp;&nbsp;&nbsp;
                En deuda:&nbsp;{{ clients[client - 1].unpaid }}
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
          if (this.clients[val - 1].unpaid >= this.clients[val - 1].notes && this.clients[val - 1].notes > 0) {
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
