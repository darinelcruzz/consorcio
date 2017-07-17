<template lang="html">
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1" data-toggle="tab">Tab 1</a></li>
        <li><a href="#tab_2" data-toggle="tab">Tab 2</a></li>
        <li><a href="#tab_3" data-toggle="tab">Tab 3</a></li>
      </ul>

      <div class="tab-content">

        <div class="tab-pane active" id="tab_1">
            <slot name="tab1"></slot>
        </div><!-- /.tab-pane -->

        <div class="tab-pane" id="tab_2">
            <slot name="tab2"></slot>
        </div><!-- /.tab-pane -->

        <div class="tab-pane" id="tab_3">
            <slot name="tab3"></slot>
        </div><!-- /.tab-pane -->

      </div><!-- /.tab-content -->

    </div><!-- nav-tabs-custom -->
</template>

<script>
export default {
    props: ['tabNames']
}
</script>

<style lang="css">
</style>
