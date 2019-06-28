<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MENÚ</li>
            @if (auth()->user()->level == 1)
                @each('adminlte::layouts.partials.menu_items', trans('menus/one'), 'item')
            @else
                @each('adminlte::layouts.partials.menu_items', trans('menus/two'), 'item')
            @endif
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
