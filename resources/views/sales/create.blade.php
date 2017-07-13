@extends('admin')

@section('main-content')

    <div class="row">

        <div class="col-md-6">

            <solid-box title="Introduzca los datos de la venta"
                color="{{ 'box-' . $color }}">
                {!! Form::open(['method' => 'POST', 'route' => 'pork.store']) !!}
                    {!! Field::select('client_id', $clients, null,
                        ['tpl' => 'templates/withicon', 'empty' => 'Seleccione un cliente'],
                        ['icon' => 'user'])
                    !!}
                    <div class="row">
                        <div class="col-md-6">
                            {!! Field::number('folio', ['tpl' => 'templates/withicon'], ['icon' => 'barcode']) !!}
                        </div>

                        <div class="col-md-6">
                            {!! Field::text('date', ['tpl' => 'templates/withicon'], ['icon' => 'calendar']) !!}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            {!! Field::number('quantity', ['tpl' => 'templates/withicon'],
                                ['icon' => 'list-ol']) !!}
                        </div>

                        <div class="col-md-6">
                            {!! Field::number('kg', ['tpl' => 'templates/withicon'],
                                ['icon' => 'balance-scale']) !!}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            {!! Field::select('price', ['1' => '1'], null,
                                ['tpl' => 'templates/withicon', 'empty' => 'Tipo de precio'],
                                ['icon' => 'money']) !!}
                        </div>

                        <div class="col-md-6">
                            {!! Field::number('amount', ['tpl' => 'templates/withicon', 'step' => '0.01'],
                                ['icon' => 'usd']) !!}
                        </div>
                    </div>

                    <input type="hidden" name="credit" value="0">
                    <input type="hidden" name="days" value="0">
                    <input type="hidden" name="status" value="pendiente">
                    {!! Form::submit('Agregar', ['class' => 'btn btn-' . $color . ' pull-right']) !!}

                {!! Form::close() !!}
            </solid-box>

        </div>

    </div>

@endsection
