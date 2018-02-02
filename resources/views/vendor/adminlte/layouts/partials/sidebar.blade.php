<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar Menu -->
        @if (auth()->user()->level == 1)
            @include('adminlte::layouts.partials.menu_items', ['items' => trans('menus/one')])
        @else
            @include('adminlte::layouts.partials.menu_items', ['items' => trans('menus/two')])
        @endif
    </section>
    <!-- /.sidebar -->
</aside>
