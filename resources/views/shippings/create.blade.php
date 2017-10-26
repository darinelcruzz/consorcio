@extends('admin')

@section('main-content')

    <div class="row">

        <div class="col-md-6">

            <solid-box title="Introduzca los datos del embarque"
                color="box-warning">
                {!! Form::open(['method' => 'POST', 'route' => 'shipping.store']) !!}
                    <div class="row">
                        <div class="col-md-6">
                            {!! Field::text('remission', ['tpl' => 'templates/withicon'], ['icon' => 'barcode']) !!}
                        </div>

                        <div class="col-md-6">
                            {!! Field::date('date', $today,['tpl' => 'templates/withicon'], ['icon' => 'calendar']) !!}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            {!! Field::select('provider', ['1' => 'Buenaventura'], null,
                                ['tpl' => 'templates/withicon', 'empty' => 'Escoja un proveedor'],
                                ['icon' => 'truck'])
                            !!}
                        </div>
                        <div class="col-md-6">
                            {!! Field::select('product', $products->toArray(), null,
                                ['tpl' => 'templates/withicon', 'empty' => 'Escoja un producto'],
                                ['icon' => 'cutlery'])
                            !!}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            {!! Field::number('quantity', ['tpl' => 'templates/withicon', 'min' => '0', 'step' => '0.1'],
                                ['icon' => 'list-ol']) !!}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            {!! Field::number('price', ['tpl' => 'templates/withicon', 'min' => '0', 'step' => '0.1'],
                                ['icon' => 'money']) !!}
                        </div>

                        <div class="col-md-6">
                            {!! Field::number('amount', ['tpl' => 'templates/withicon', 'min' => '0', 'step' => '0.1'],
                                ['icon' => 'usd']) !!}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            {!! Field::text('observations', ['tpl' => 'templates/withicon'], ['icon' => 'eye']) !!}
                        </div>
                    </div>

                    {!! Form::submit('Agregar', ['class' => 'btn btn-warning pull-right']) !!}

                {!! Form::close() !!}
            </solid-box>

        </div>

    </div>

@endsection
