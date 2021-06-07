<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- search form (Optional) -->
        {!! Form::open(['method' => 'post', 'route' => 'sale.search', 'class' => 'sidebar-form']) !!}
        {{-- <form action="#" method="get" class="sidebar-form"> --}}
          <div class="input-group">
            <input type="text" name="note" class="form-control" placeholder="Buscar nota...">
            <span class="input-group-btn">
                  <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                  </button>
                </span>
          </div>
        {!! Form::close() !!}
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MENÚ</li>
            @if (auth()->user()->level == 1)
                @each('adminlte::layouts.partials.menu_items', trans('menus/one'), 'item')
            @elseif(auth()->user()->level == 2)
                @each('adminlte::layouts.partials.menu_items', trans('menus/two'), 'item')
            @else
                @each('adminlte::layouts.partials.menu_items', trans('menus/three'), 'item')
            @endif
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
