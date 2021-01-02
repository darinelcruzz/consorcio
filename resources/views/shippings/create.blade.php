@extends('admin')

@section('main-content')

    {!! Form::open(['method' => 'POST', 'route' => 'shipping.store']) !!}
    <div class="row">

        <div class="col-md-8">

            <solid-box title="Introduzca los datos del embarque"
                color="box-warning">
                    <div class="row">
                        <div class="col-md-6">
                            {!! Field::text('remission', ['label' => 'Remisión/Factura', 'tpl' => 'templates/withicon', 'maxlength' => '10', 'ph' => 'ejemplo: 9081726354'],
                                ['icon' => 'barcode']) !!}
                        </div>

                        <div class="col-md-6">
                            {!! Field::date('date', date('Y-m-d'), ['tpl' => 'templates/withicon'], ['icon' => 'calendar']) !!}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            {!! Field::select('provider', ['buenaventura' => 'Buenaventura', 'avimarca' => 'Avimarca', 'bachoco' => 'Bachoco', 'con marca' => 'Con Marca'], null,
                                ['tpl' => 'templates/withicon', 'empty' => 'Escoja un proveedor'],
                                ['icon' => 'truck'])
                            !!}
                        </div>
                        <div class="col-md-6">
                            {!! Field::select('items[0][product_id]', 
                                [1 => 'Cerdo', 3 => 'Pollo vivo', 18 => 'Alimento cerdo', 19 => 'Alimento pollo', 20 => 'Rangos', 23 => 'Cortes'], null,
                                ['label' => 'Producto', 'tpl' => 'templates/withicon', 'empty' => 'Escoja un producto', 'v-model.number' => 'shipp'],
                                ['icon' => 'cutlery'])
                            !!}
                        </div>
                    </div>

                    <div v-if="shipp < 20 && shipp != ''" class="row">
                        <div class="col-md-6">
                            {!! Field::number('items[0][quantity]', 1,
                                [ 'label' => 'Cantidad', 'tpl' => 'templates/withicon', 'step' => '1', 'min' => '1'],
                                ['icon' => 'list-ol'])
                            !!}
                        </div>
                        <div class="col-md-6">
                            {!! Field::number('items[0][kg]', 1,
                                ['label' => 'Kilogramos', 'tpl' => 'templates/withicon', 'step' => '0.01', 'min' => '0.01'],
                                ['icon' => 'balance-scale'])
                            !!}
                        </div>
                    </div>

                    <div v-if="shipp < 20 && shipp != ''" class="row">
                        <div class="col-md-6">
                            {!! Field::number('items[0][price]', 0,
                                ['label' => 'Precio', 'tpl' => 'templates/withicon', 'step' => '0.01', 'min' => '0.01'],
                                ['icon' => 'usd'])
                            !!}
                        </div>
                        <div class="col-md-6">
                            {!! Field::number('amount', 0,
                                ['tpl' => 'templates/withicon', 'step' => '0.01', 'min' => '0.01'],
                                ['icon' => 'money'])
                            !!}
                        </div>
                    </div>

                    <input v-if="shipp >= 20" type="hidden" name="product" :value="shipp">

                    <div class="row">
                        <div class="col-md-12">
                            {!! Field::text('observations', ['tpl' => 'templates/withicon'], ['icon' => 'eye']) !!}
                        </div>
                    </div>

                    <product-table v-if="shipp >= 20" model="envio"></product-table>
                    @foreach($errors->get('items') as $message)
                        <h5><code><em>NO AGREGASTE NINGÚN PRODUCTO</em></code></h5>
                    @endforeach

                    {!! Form::submit('Agregar', ['class' => 'btn btn-warning pull-right']) !!}
                
                {!! Form::close() !!}

            </solid-box>

        </div>

        <div class="col-md-4" v-if="shipp >= 20">
            <solid-box color="box-warning" title="Productos">
                <chicken-cuts :type="shipp"></chicken-cuts>
            </solid-box>
        </div>

    </div>

@endsection
