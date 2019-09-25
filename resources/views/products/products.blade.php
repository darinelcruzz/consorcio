@extends('admin')

@section('main-content')

    <row-woc col="col-md-8 col-md-offset-2">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-widget widget-user-2">
                    <div class="widget-user-header bg-green">
                        Pollo procesado
                    </div>
                    <div class="box-footer no-padding">
                        <ul class="nav nav-stacked">
                            @foreach ($products->where('processed', 1)->pluck('quantity', 'name')->slice(16) as $key => $value)
                                <li><a href="#">{{ $key }}<span class="pull-right badge bg-green">{{ $value }}</span></a></li>
                            @endforeach

                            @foreach ($products->where('processed', 1)->pluck('quantity', 'name')->slice(0, 16) as $key => $value)
                                <li><a href="#">{{ $key }}<span class="pull-right badge bg-green">{{ $value }}</span></a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                @component('products.stockbox', [
                    'product' => $products->where('name', 'Cerdo')->pluck('quantity', 'name'),
                    'labelcolor' => 'fuchsia'
                ])
                    Cerdo
                @endcomponent

                @component('products.stockbox', [
                    'product' => $products->where('name', 'Pollo vivo')->pluck('quantity', 'name'),
                    'labelcolor' => 'blue'])
                    Pollo vivo
                @endcomponent

                @component('products.stockbox', [
                    'product' => $products->where('processed', 2)->pluck('quantity', 'name'),
                    'labelcolor' => 'purple'
                ])
                    Alimento
                @endcomponent

            </div>
        </div>
    </row-woc>

@endsection
