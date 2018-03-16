@extends('admin')

@section('main-content')

    <row-woc col="col-md-8 col-md-offset-2">
        <div class="row">
            <div class="col-md-6">
                @component('products.stockbox', [
                    'product' => $products->where('processed', 1)->pluck('quantity', 'name'),
                    'labelcolor' => 'green'
                ])
                    Pollo procesado
                @endcomponent
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
