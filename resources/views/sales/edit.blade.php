@extends('admin')

@section('main-content')

    <div class="row">

        <div class="col-md-7">

            <solid-box title="Venta #{{ $sale->series }}{{ $sale->folio }} de {{ $sale->client->name }}" color="box-{{ $color }}">

                {!! Form::open(['method' => 'POST', 'route' => ['sale.update', $type, $sale->id]]) !!}

                    <div class="row">
                        <div class="col-md-6">
                            {!! Field::select('client_id', $clients, $sale->client_id,
                                ['label' => '¿Cambiar cliente?', 'tpl' => 'templates/withicon', 'empty' => 'Seleccione un cliente'],
                                ['icon' => 'user'])
                            !!}
                        </div>
                        <div class="col-md-6">
                            {!! Field::number('folio', $sale->folio, ['tpl' => 'templates/withicon'], ['icon' => 'barcode']) !!}
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
                                ['tpl' => 'templates/withicon','empty' => 'Seleccione un precio'],
                                ['icon' => 'money'])
                            !!}

                            @foreach($prices2 as $id => $value)
                                <input v-if="sale.price == {{ $id }}" type="hidden" name="items[0][price]" value="{{ $value }}">
                            @endforeach
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            {!! Field::number('quantity', $sale->quantity,
                                ['label' => 'Pollos', 'tpl' => 'templates/withicon', 'step' => '0.01', 'min' => '0' ],
                                ['icon' => 'list-ol']) !!}
                                <input type="hidden" name="items[0][quantity]" value="{{ $sale->quantity }}">
                        </div>

                        <div class="col-md-6">
                            {!! Field::number('kg', $sale->kg,
                                ['label' => 'Kilogramos', 'tpl' => 'templates/withicon', 'step' => '0.01', 'min' => '0' ],
                                ['icon' => 'balance-scale']) !!}
                                <input type="hidden" name="items[0][kg]" value="{{ $sale->kg }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            {!! Field::number('amount', $sale->amount,
                                ['tpl' => 'templates/withicon', 'step' => '0.01', 'min' => '0' ],
                                ['icon' => 'usd']) !!}
                        </div>
                        @if($sale->credit > 0)
                            <div class="col-md-6">
                                {!! Field::select('days', ['0' => 'No', '8' => 'Semanal', '15' => 'Quince días'], $sale->days,
                                    ['label' => 'Crédito', 'tpl' => 'templates/withicon','empty' => '¿Se vende a crédito?'],
                                    ['icon' => 'credit-card-alt'])
                                    !!}
                            </div>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            {!! Field::text('observations', $sale->observations, ['tpl' => 'templates/withicon'], ['icon' => 'eye']) !!}
                        </div>
                    </div>

                    {!! Form::submit('Cambiar', ['class' => 'btn btn-' . $color . ' pull-right']) !!}

                {!! Form::close() !!}
            </solid-box>

        </div>

    </div>
@endsection
