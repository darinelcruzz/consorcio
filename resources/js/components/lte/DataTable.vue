<template lang="html">
    <row-woc :col="col">
        <solid-box :title="title" :color="color" :collapsed="collapsed">
            <div class="table-responsive">
                <table :id="example" class="table table-bordered table-striped">
                    <thead>
                        <slot name="header"></slot>
                    </thead>
                    <tbody>
                        <slot name="body"></slot>
                    </tbody>
                    <tfoot>
                        <slot name="footer"></slot>
                    </tfoot>
                </table>
            </div>
        </solid-box>
    </row-woc>
</template>

<script>
export default {
    props: ['col', 'title', 'example', 'color', 'collapsed'],
}
</script>
