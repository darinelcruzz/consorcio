<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MENÚ</li>
            @if (auth()->user()->level == 1)
                {{-- @include('adminlte::layouts.partials.menu_items', ['items' => trans('menus/one')]) --}}
                @each('adminlte::layouts.partials.menu_items', trans('menus/one'), 'item')
            @else
                {{-- @include('adminlte::layouts.partials.menu_items', ['items' => trans('menus/two')]) --}}
                @each('adminlte::layouts.partials.menu_items', trans('menus/two'), 'item')
            @endif
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
