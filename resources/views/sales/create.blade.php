@extends('admin')

@section('main-content')

    <div class="row">

        <div class="col-md-7">

            <solid-box title="Introduzca los datos de la venta {{ $lastSale ? $folio: 1 }}"
                color="box-{{ $color }}">
                {!! Form::open(['method' => 'POST', 'route' => ['sale.store', $type]]) !!}

                    <div class="row">
                        <div class="col-md-6">
                            <client-select product="{{ $type }}"></client-select>
                        </div>

                        <div v-if="selected_date.substring(2, 4) == '21' && 0 == {{ $yearCount }}" class="col-md-6">
                            {!! Field::text('folio', 1,
                                ['disabled' => '', 'tpl' => 'templates/withicon'],
                                ['icon' => 'barcode'])
                            !!}
                            <input type="hidden" name="folio" value="{{ 1 }}">
                            <input type="hidden" name="series" value="{{ $nextSeries }}">
                        </div>

                        <div v-else class="col-md-6">
                            {!! Field::text('folio', $lastSale ? $folio: 1,
                                ['disabled' => '', 'tpl' => 'templates/withicon'],
                                ['icon' => 'barcode'])
                            !!}
                            <input type="hidden" name="folio" value="{{ $lastSale ? $folio: 1 }}">
                            <input type="hidden" name="series" value="{{ $series }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            {!! Field::select('date', $validDates, null,
                                ['tpl' => 'templates/withicon', 'empty' => 'Seleccione la fecha', 'v-model' => 'selected_date'],
                                ['icon' => 'calendar'])
                            !!}
                        </div>
                        <div class="col-md-6">
                            {!! Field::select('price', $prices->toArray(), null,
                                ['label' => 'Precio', 'tpl' => 'templates/withicon','empty' => 'Seleccione un precio', 'v-model.number' => 'sale.price'],
                                ['icon' => 'money'])
                            !!}

                            @foreach($pricesAlt as $id => $value)
                                <input v-if="sale.price == {{ $id }}" type="hidden" name="items[0][price]" value="{{ $value }}">
                            @endforeach
                        </div>
                    </div>

                    @if ($type != 'procesado')

                        <div class="row">
                            <div class="col-md-6">
                                {!! Field::number('quantity', ['label' => 'Cantidad', 'tpl' => 'templates/withicon', 'v-model.number' => 'sale.quantity', 'step' => '0.01', 'min' => '0' ],
                                    ['icon' => 'list-ol']) !!}
                                    <input type="hidden" name="items[0][quantity]" :value="sale.quantity">
                            </div>

                            <div class="col-md-6">
                                {!! Field::number('kg', ['label' => 'Kg', 'tpl' => 'templates/withicon', 'v-model.number' => 'sale.kg', 'step' => '0.01', 'min' => '0' ],
                                    ['icon' => 'balance-scale']) !!}
                                    <input type="hidden" name="items[0][kg]" :value="sale.kg">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                {!! Field::number('amount', 0, ['tpl' => 'templates/withicon', 'step' => '0.01', 'min' => '0' ],
                                    ['icon' => 'usd']) !!}
                            </div>
                            <div class="col-md-6">
                                <client-credit></client-credit>
                            </div>
                        </div>
                    @else
                        <div class="row">
                            <div class="col-md-6">
                                <client-credit></client-credit>
                            </div>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-12">
                            {!! Field::text('observations', ['tpl' => 'templates/withicon'], ['icon' => 'eye']) !!}
                        </div>
                    </div>

                    @if ($type == 'procesado')
                        <product-table></product-table>
                    @else
                        <input type="hidden" name="items[0][product_id]" value="{{ $product_id }}">
                    @endif

                    <input type="hidden" name="days" value="0">
                    <input type="hidden" name="status" value="pagado">
                    
                    <button type="submit" class="btn btn-{{ $color }} pull-right" onclick="submitForm(this);">Agregar</button>

                {!! Form::close() !!}
            </solid-box>

        </div>

        <div class="col-md-5">

            <client-info></client-info>

            @if ($lastSale)
                <div class="box box-solid">
                    <div class="box-header with-border">
                      <i class="fa fa-shopping-cart"></i>

                      <h3 class="box-title">Última venta hecha</h3>
                    </div><!-- /.box-header -->

                    <div class="box-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Folio</th>
                                    <th>Cliente</th>
                                    <th>Fecha</th>
                                    <th>Pollos</th>
                                    <th>Importe</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><b>{{ $lastSale->series }}</b>{{ substr("00000" . $lastSale->folio, -5) }}</td>
                                    <td>{{ $lastSale->client->name or 'Cancelada'}}</td>
                                    <td>{{ date('d/m/y', strtotime($lastSale->date)) }}</td>
                                    <td style="text-align: center;">{{ $lastSale->quantity }}</td>
                                    <td style="text-align: right;">{{ number_format($lastSale->amount, 2) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            @endif

            {!! Form::open(['method' => 'POST', 'route' => ['sale.cancel', $type]]) !!}
                <input type="hidden" name="selected_date" :value="selected_date">
                <input type="hidden" name="folio" value="{{ $folio }}">
                <div v-if="selected_date != ''">
                    {!! Form::submit('CANCELAR FOLIO', ['class' => 'btn btn-danger pull-left']) !!}
                </div>
            {!! Form::close() !!}

            <br><br>

            @if($type == 'procesado')
                <div class="row">
                    <div class="col-md-12">
                        <solid-box color="box-{{ $color }}" title="Rangos o cortes">
                            <chicken-cuts :type="sale.price"></chicken-cuts>
                        </solid-box>
                    </div>
                </div>
            @endif

        </div>

    </div>
@endsection
