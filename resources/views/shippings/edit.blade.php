@extends('admin')

@section('main-content')

    {!! Form::open(['method' => 'POST', 'route' => ['shipping.update', $shipping]]) !!}
    <div class="row">

        <div class="col-md-8">

            <solid-box title="Introduzca los datos del embarque"
                color="box-warning">
                    <div class="row">
                        <div class="col-md-6">
                            {!! Field::text('remission', $shipping->remission, ['tpl' => 'templates/withicon', 'maxlength' => '10', 'ph' => 'ejemplo: 9081726354'],
                                ['icon' => 'barcode']) !!}
                        </div>

                        <div class="col-md-6">
                            {!! Field::date('date', $shipping->date, ['tpl' => 'templates/withicon'], ['icon' => 'calendar']) !!}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            {!! Field::select('provider', ['buenaventura' => 'Buenaventura', 'avimarca' => 'Avimarca', 'bachoco' => 'Bachoco', 'con marca' => 'Con Marca'], $shipping->provider,
                                ['tpl' => 'templates/withicon', 'empty' => 'Escoja un proveedor'],
                                ['icon' => 'truck'])
                            !!}
                        </div>
                        <div class="col-md-6">
                            {!! Field::select('product', [1 => 'Cerdo', 3 => 'Pollo vivo', 18 => 'Alimento cerdo', 19 => 'Alimento pollo', 20 => 'Rangos', 23 => 'Cortes'], $shipping->product,
                                ['tpl' => 'templates/withicon', 'empty' => 'Escoja un producto', 'disabled' => 'true'],
                                ['icon' => 'cutlery'])
                            !!}
                            <input type="hidden" name="items[0][product_id]" value="{{ $shipping->product }}">
                        </div>
                    </div>

                    @if($shipping->product < 20)
                    <div class="row">
                        <div class="col-md-6">
                            {!! Field::number('items[0][quantity]', $shipping->quantity,
                                [ 'label' => 'Cantidad', 'tpl' => 'templates/withicon', 'step' => '1', 'min' => '1'],
                                ['icon' => 'list-ol'])
                            !!}
                        </div>
                        <div class="col-md-6">
                            {!! Field::number('items[0][kg]', $shipping->movements->first()->kg ?? 0,
                                ['label' => 'Kilogramos', 'tpl' => 'templates/withicon', 'step' => '0.01', 'min' => '0.01'],
                                ['icon' => 'balance-scale'])
                            !!}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            {!! Field::number('items[0][price]', $shipping->price,
                                ['label' => 'Precio', 'tpl' => 'templates/withicon', 'step' => '0.01', 'min' => '0.01'],
                                ['icon' => 'usd'])
                            !!}
                        </div>
                        <div class="col-md-6">
                            {!! Field::number('amount', $shipping->amount,
                                ['tpl' => 'templates/withicon', 'step' => '0.01', 'min' => '0.01'],
                                ['icon' => 'money'])
                            !!}
                        </div>
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-md-12">
                            {!! Field::text('observations', $shipping->observations, ['tpl' => 'templates/withicon'], ['icon' => 'eye']) !!}
                        </div>
                    </div>

                    <product-table v-if="{{ $shipping->product }} >= 20" :stored="{{ json_encode($shipping->products) }}" model="envio"></product-table>

                    {!! Form::submit('EDITAR', ['class' => 'btn btn-warning pull-right']) !!}
                
                {!! Form::close() !!}

            </solid-box>

        </div>

        @if($shipping->product >= 20)
        <div class="col-md-4">
            <solid-box color="box-warning" title="Productos">
                <chicken-cuts type="{{ $shipping->product}}"></chicken-cuts>
            </solid-box>
        </div>
        @endif
    </div>

@endsection
