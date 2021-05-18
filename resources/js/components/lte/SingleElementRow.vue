<template lang="html">
    <div class="row">
        <div :class="col">
            <slot></slot>
        </div>
    </div>
</template>

<script>
export default {
    props: ['col'],
}
</script>
