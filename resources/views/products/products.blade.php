@extends('admin')

@section('main-content')

    <row-woc col="col-md-8 col-md-offset-2">
        <div class="row">
            <div class="col-md-6">
                @component('products.stockbox', ['product' => $processed, 'labelcolor' => 'green'])
                    Pollo procesado
                @endcomponent
            </div>

            <div class="col-md-6">
                @component('products.stockbox', ['product' => 'Cerdo', 'labelcolor' => 'fuchsia'])
                    {{ $pork }}
                @endcomponent

                @component('products.stockbox', ['product' => 'Pollo vivo', 'labelcolor' => 'blue'])
                    {{ $alive }}
                @endcomponent

                @component('products.stockbox', [
                    'product' => $food->where('name', '!=', 'Procesado')->pluck('quantity', 'name'), 
                    'labelcolor' => 'purple'
                ])
                    Alimento
                @endcomponent

            </div>
        </div>
    </row-woc>

@endsection
