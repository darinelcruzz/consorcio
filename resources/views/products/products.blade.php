@extends('admin')

@section('main-content')

    <row-woc col="col-md-8 col-md-offset-2">
        <div class="row">
            <div class="col-md-6">
                @component('products.stockbox', ['products' => $processed, 'labelcolor' => 'green'])
                    <div class="widget-user-header bg-green">
                        <h3>Pollo procesado</h3>
                    </div>
                @endcomponent
            </div>

            <div class="col-md-6">
                <div class="box box-widget widget-user-2">
                    <div class="widget-user-header bg-baby">
                        <h3>Cerdo</h3>
                    </div>
                    <div class="box-footer no-padding">
                        <ul class="nav nav-stacked">
                            <li><a href="#">Cerdo<span class="pull-right badge bg-fuchsia">{{ $pork }}</span></a></li>
                        </ul>
                    </div>
                </div>

                <div class="box box-widget widget-user-2">
                    <div class="widget-user-header bg-primary">
                        <h3>Pollo vivo</h3>
                    </div>
                    <div class="box-footer no-padding">
                        <ul class="nav nav-stacked">
                            <li><a href="#">Pollo vivo<span class="pull-right badge bg-blue">{{ $alive }}</span></a></li>
                        </ul>
                    </div>
                </div>

                @component('products.stockbox', ['products' => $food, 'labelcolor' => 'purple'])
                    <div class="widget-user-header bg-purple">
                        <h3>Alimento</h3>
                    </div>
                @endcomponent

            </div>
        </div>
    </row-woc>

@endsection
