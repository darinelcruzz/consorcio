<template lang="html">
    <div :class="[color, {'box box-solid': true, 'collapsed-box': isCollapsed}]">
        <div class="box-header with-border">
            <h3 class="box-title">{{ title }}</h3>
            <div v-if="collapsed != ''" class="box-tools pull-right">
              <button class="btn btn-box-tool" data-widget="collapse">
                  <i :class="{'fa fa-minus': !isCollapsed, 'fa fa-plus': isCollapsed}"></i>
              </button>
            </div>
        </div>

        <div class="box-body">
            <slot></slot>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            isCollapsed: false
        };
    },
    props: ['title', 'color', 'collapsed'],
    created() {
        this.isCollapsed = this.collapsed == 'collapsed-box';
    }
}
</script>
