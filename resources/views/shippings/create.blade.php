@extends('admin')

@section('main-content')

    <div class="row">

        <div class="col-md-12">

            <solid-box title="Introduzca los datos del embarque"
                color="box-warning">
                {!! Form::open(['method' => 'POST', 'route' => 'shipping.store']) !!}
                    <div class="row">
                        <div class="col-md-6">
                            {!! Field::text('remission', ['tpl' => 'templates/withicon'], ['icon' => 'barcode']) !!}
                        </div>

                        <div class="col-md-6">
                            {!! Field::date('date', ['tpl' => 'templates/withicon'], ['icon' => 'calendar']) !!}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            {!! Field::select('provider', ['1' => 'Buenaventura'], null,
                                ['tpl' => 'templates/withicon', 'empty' => 'Seleccione un proveedor'],
                                ['icon' => 'truck'])
                            !!}
                        </div>
                        <div class="col-md-6">
                            {!! Field::select('product', ['1' => 'Cerdo'], null,
                                ['tpl' => 'templates/withicon', 'empty' => 'Seleccione un producto'],
                                ['icon' => 'truck'])
                            !!}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            {!! Field::number('quantity', ['tpl' => 'templates/withicon'],
                                ['icon' => 'list-ol']) !!}
                        </div>

                        <div class="col-md-4">
                            {!! Field::number('price', ['tpl' => 'templates/withicon'],
                                ['icon' => 'money']) !!}
                        </div>

                        <div class="col-md-4">
                            {!! Field::number('amount', ['tpl' => 'templates/withicon', 'step' => '0.01'],
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
