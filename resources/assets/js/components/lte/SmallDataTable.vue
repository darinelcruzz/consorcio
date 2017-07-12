<template lang="html">
    <solid-box :title="title" :color="color">
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
</template>

<script>
export default {
    props: ['title', 'example', 'color'],
}
</script>
