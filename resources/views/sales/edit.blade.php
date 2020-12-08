@extends('admin')

@section('main-content')

    <div class="row">

        <div class="col-md-7">

            <solid-box title="Venta #{{ $sale->series }}{{ $sale->folio }}" color="box-{{ $color }}">

                {!! Form::open(['method' => 'POST', 'route' => ['sale.update', $type, $sale->id]]) !!}

                    <div class="row">
                        <div class="col-md-6">
                            {!! Field::select('client_id', $clients, $sale->client_id,
                                ['tpl' => 'templates/withicon', 'empty' => 'Seleccione un cliente', 'disabled' => 'true'],
                                ['icon' => 'user'])
                            !!}
                        </div>
                        <div class="col-md-6">
                            {!! Field::number('folio', $sale->folio, ['tpl' => 'templates/withicon', 'disabled' => 'true'], ['icon' => 'barcode']) !!}
                        </div>
                    </div>
                    

                    <div class="row">
                        <div class="col-md-6">
                            {!! Field::date('date', $sale->date,
                                ['tpl' => 'templates/withicon', 'empty' => 'Seleccione la fecha'],
                                ['icon' => 'calendar'])
                            !!}
                        </div>
                        <div class="col-md-6">
                            {!! Field::select('price', $prices->toArray(), $sale->price,
                                ['tpl' => 'templates/withicon','empty' => 'Seleccione un precio', 'v-on:change' => 'onChange($event)'],
                                ['icon' => 'money'])
                            !!}
                        </div>
                    </div>

                     @if ($type != 'procesado')

                        <div class="row">
                            <div class="col-md-6">
                                {!! Field::number('quantity', $sale->quantity,
                                    ['label' => 'Pollos', 'tpl' => 'templates/withicon', 'min' => '0' ],
                                    ['icon' => 'list-ol']) !!}
                            </div>

                            <div class="col-md-6">
                                {!! Field::number('kg', $sale->kg,
                                    ['label' => 'Kilogramos', 'tpl' => 'templates/withicon', 'step' => '0.01', 'min' => '0' ],
                                    ['icon' => 'balance-scale']) !!}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                {!! Field::number('amount', $sale->amount,
                                    ['tpl' => 'templates/withicon', 'step' => '0.01', 'min' => '0' ],
                                    ['icon' => 'usd']) !!}
                            </div>
                            @if($sale->client->credit > 0)
                                <div class="col-md-6">
                                    {!! Field::select('days', ['0' => 'No', '8' => 'Semanal', '15' => 'Quince días'], $sale->days,
                                        ['label' => 'Crédito', 'tpl' => 'templates/withicon','empty' => '¿Se vende a crédito?'],
                                        ['icon' => 'credit-card-alt'])
                                        !!}
                                </div>
                            @else
                                <input type="hidden" name="days" value="0">
                            @endif
                        </div>
                    @else
                        @if($sale->client->credit > 0)
                            <div class="row">
                                <div class="col-md-6">
                                    {!! Field::select('days', ['0' => 'No', '8' => 'Semanal', '15' => 'Quince días'], $sale->days,
                                        ['label' => 'Crédito', 'tpl' => 'templates/withicon','empty' => '¿Se vende a crédito?'],
                                        ['icon' => 'credit-card-alt'])
                                        !!}
                                </div>
                            </div>
                        @else
                            <input type="hidden" name="days" value="0">
                        @endif
                    @endif

                    {!! Field::text('observations', $sale->observations, ['tpl' => 'templates/withicon'], ['icon' => 'eye']) !!}

                    @if ($type == 'procesado')
                        <product-table :stored="{{ json_encode($sale->cutsAndRanges) }}"></product-table>
                    @endif

                    <hr>

                    <a href="{{ route('sale.index', $type) }}" class="btn btn-danger">
                        <i class="fa fa-arrow-left"></i> &nbsp;&nbsp;&nbsp; REGRESAR
                    </a>

                    <button type="submit" class="btn btn-{{ $color }} pull-right">
                        <i class="fa fa-save"></i> &nbsp;&nbsp;&nbsp; CAMBIAR
                    </button>

                {!! Form::close() !!}
            </solid-box>

        </div>

    </div>
@endsection
