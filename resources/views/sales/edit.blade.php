@extends('admin')

@section('main-content')

    <div class="row">

        <div class="col-md-7">

            <solid-box title="Modifique los datos según convenga"
                color="box-{{ $color }}">
                <h3 align="center">
                    Venta con ID <code>{{ $processedSale->id }}</code>, folio <code>{{ $processedSale->folio }}</code> <br>
                    del cliente <b>{{ $processedSale->client->name }}</b>
                </h3>
                <hr>
                {!! Form::open(['method' => 'POST', 'route' => $type . '.update']) !!}
                    {!! Field::select('client_id', $clients, $processedSale->client_id,
                        ['label' => '¿Cambiar cliente?', 'tpl' => 'templates/withicon', 'empty' => 'Seleccione un cliente'],
                        ['icon' => 'user'])
                    !!}

                    <div class="row">
                        <div class="col-md-6">
                            {!! Field::number('folio', $processedSale->folio,
                                ['tpl' => 'templates/withicon'],
                                ['icon' => 'barcode'])
                            !!}
                        </div>
                        <div class="col-md-6">
                            {!! Field::date('date', $processedSale->date,
                                ['tpl' => 'templates/withicon', 'empty' => 'Seleccione la fecha'],
                                ['icon' => 'calendar'])
                            !!}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            {!! Field::number('quantity', $processedSale->quantity,
                                ['tpl' => 'templates/withicon', 'step' => '0.01', 'min' => '0' ],
                                ['icon' => 'list-ol']) !!}
                        </div>

                        <div class="col-md-6">
                            {!! Field::number('kg', $processedSale->kg,
                                ['tpl' => 'templates/withicon', 'step' => '0.01', 'min' => '0' ],
                                ['icon' => 'balance-scale']) !!}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            {!! Field::select('price', $prices->toArray(), $processedSale->price,
                                ['tpl' => 'templates/withicon','empty' => 'Seleccione un precio'],
                                ['icon' => 'money'])
                            !!}
                        </div>

                        <div class="col-md-6">
                            {!! Field::number('amount', $processedSale->amount,
                                ['tpl' => 'templates/withicon', 'step' => '0.01', 'min' => '0' ],
                                ['icon' => 'usd']) !!}
                        </div>
                    </div>

                    <div v-if="clients[client_id]" class="row">
                        <div v-if="clients[client_id].credit"  class="col-md-6">
                            {!! Field::select('credit', ['No', 'Semanal', 'Quince días'], null,
                                ['tpl' => 'templates/withicon','empty' => '¿Se vende a crédito?'],
                                ['icon' => 'credit-card-alt'])
                                !!}
                        </div>
                        <input v-else type="hidden" name="credit" value="0">
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            {!! Field::text('observations', $processedSale->observations, ['tpl' => 'templates/withicon'], ['icon' => 'eye']) !!}
                        </div>
                    </div>

                    @if ($type == 'processed')
                        <div class="row">
                            <div class="col-md-6">
                                {!! Field::number('chickens', $processedSale->chickens,
                                    ['label' => 'Pollos/Cortes totales', 'tpl' => 'templates/withicon', 'min' => '0'],
                                    ['icon' => 'cutlery']) !!}
                            </div>

                            <div class="col-md-6">
                                {!! Field::number('boxes', $processedSale->boxes,
                                    ['label' => 'Cajas totales', 'tpl' => 'templates/withicon', 'min' => '0'],
                                    ['icon' => 'archive']) !!}
                            </div>
                        </div>
                    @endif

                    <input type="hidden" name="id" value="{{ $processedSale->id}}">

                    {!! Form::submit('Cambiar', ['class' => 'btn btn-' . $color . ' pull-right']) !!}

                {!! Form::close() !!}
            </solid-box>

        </div>

    </div>
@endsection
