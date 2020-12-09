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
                            {!! Field::select('product', [1 => 'No procesados', 20 => 'Rangos', 23 => 'Cortes'], $shipping->product >= 20 ?? 1,
                                ['tpl' => 'templates/withicon', 'empty' => 'Escoja un producto'],
                                ['icon' => 'cutlery'])
                            !!}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            {!! Field::text('observations', $shipping->observations, ['tpl' => 'templates/withicon'], ['icon' => 'eye']) !!}
                        </div>
                    </div>

                    <product-table :stored="{{ json_encode($shipping->products) }}" model="envio"></product-table>

                    {!! Form::submit('EDITAR', ['class' => 'btn btn-warning pull-right']) !!}
                
                {!! Form::close() !!}

            </solid-box>

        </div>
    </div>

@endsection
