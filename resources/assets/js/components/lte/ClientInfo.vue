<template lang="html">
    <div class="small-box bg-green">
        <div v-if="client > 0" class="inner">
            <h3>{{ clients[client - 1].name }}</h3>
            <p>{{ clients[client - 1].address }}</p>
            <h4 align="right">
                Saldo:&nbsp;$0.00&nbsp;&nbsp;&nbsp;
                Máximas:{{ clients[client - 1].notes }}&nbsp;&nbsp;&nbsp;
                En deuda:&nbsp;0
            </h4>
        </div>
        <div class="icon">
            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
        </div>
    </div>
</template>

<script>
export default {
    props: ['clients', 'client']
}
</script>

<style lang="css">
</style>
