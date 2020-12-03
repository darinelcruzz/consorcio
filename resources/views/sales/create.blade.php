@extends('admin')

@section('main-content')

    <div class="row">

        <div class="col-md-7">

            <solid-box title="Introduzca los datos de la venta"
                color="box-{{ $color }}">
                {!! Form::open(['method' => 'POST', 'route' => ['sale.store', $type]]) !!}

                    <client-select product="{{ $type }}"></client-select>

                    <div class="row">
                        <div class="col-md-6">
                            {!! Field::number('folio', $lastSale ? $folio: 1,
                                ['disabled' => '', 'tpl' => 'templates/withicon'],
                                ['icon' => 'barcode'])
                            !!}
                        </div>

                        <div class="col-md-6">
                            {!! Field::select('date', $validDates, null,
                                ['tpl' => 'templates/withicon', 'empty' => 'Seleccione la fecha', 'v-model' => 'selected_date'],
                                ['icon' => 'calendar'])
                            !!}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            {!! Field::number('items[0][quantity]', ['label' => 'Cantidad', 'tpl' => 'templates/withicon', 'step' => '0.01', 'min' => '0' ],
                                ['icon' => 'list-ol']) !!}
                        </div>

                        <div class="col-md-6">
                            {!! Field::number('items[0][kg]', ['label' => 'Kg', 'tpl' => 'templates/withicon', 'step' => '0.01', 'min' => '0' ],
                                ['icon' => 'balance-scale']) !!}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            {!! Field::select('items[0][price]', $prices->toArray(), null,
                                ['label' => 'Precio', 'tpl' => 'templates/withicon','empty' => 'Seleccione un precio', 'v-model' => 'price_id'],
                                ['icon' => 'money'])
                            !!}
                        </div>

                        <div class="col-md-6">
                            {!! Field::number('amount', ['tpl' => 'templates/withicon', 'step' => '0.01', 'min' => '0' ],
                                ['icon' => 'usd']) !!}
                        </div>
                    </div>

                    <client-credit></client-credit>

                    <div class="row">
                        <div class="col-md-12">
                            {!! Field::text('observations', ['tpl' => 'templates/withicon'], ['icon' => 'eye']) !!}
                        </div>
                    </div>

                    @if ($type == 'procesado')
                        <div class="row">
                            <div class="col-md-6">
                                {!! Field::number('chickens',
                                    ['label' => 'Pollos/Cortes totales', 'tpl' => 'templates/withicon', 'min' => '0'],
                                    ['icon' => 'cutlery']) !!}
                            </div>

                            <div class="col-md-6">
                                {!! Field::number('boxes',
                                    ['label' => 'Cajas totales', 'tpl' => 'templates/withicon', 'min' => '0'],
                                    ['icon' => 'archive']) !!}
                            </div>
                        </div>

                        <row-woc col="col-md-12" v-if="price_id">
                            <product-table :pricetype="price_id"></product-table>
                        </row-woc>
                    @else
                        <input type="hidden" name="items[0][product_id]" value="{{ $product_id }}">
                    @endif

                    <input type="hidden" name="folio" value="{{ $lastSale ? $folio: 1 }}">
                    <input type="hidden" name="series" value="{{ $series }}">
                    <input type="hidden" name="days" value="0">
                    <input type="hidden" name="status" value="pagado">
                    <input type="hidden" name="quantity" value="0">
                    <input type="hidden" name="price" :value="price_id">
                    <input type="hidden" name="kg" value="0">
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
                      <dl class="dl-horizontal">
                        <dt>Cliente</dt>
                        <dd>{{ $lastSale->client->name or 'Cancelada'}}</dd>
                        <dt>Folio</dt>
                        <dd><b>{{ $lastSale->series }}</b>{{ substr("00000" . $lastSale->folio, -5) }}</dd>
                        <dt>Fecha</dt>
                        <dd>{{ $lastSale->date }}</dd>
                        <dt>Precio</dt>
                        <dd>{{ $lastSale->price }}</dd>
                        <dt>Cantidad</dt>
                        <dd>{{ $lastSale->quantity }}</dd>
                        <dt>Importe</dt>
                        <dd>$ {{ $lastSale->amount or '0.00' }}</dd>
                      </dl>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            @endif

            <hr>



            {!! Form::open(['method' => 'POST', 'route' => ['sale.discard', $type]]) !!}
                <input type="hidden" name="selected_date" :value="selected_date">
                <input type="hidden" name="folio" value="{{ $folio }}">
                <div v-if="selected_date != ''">
                    {!! Form::submit('CANCELAR FOLIO', ['class' => 'btn btn-danger pull-left']) !!}
                </div>
            {!! Form::close() !!}

        </div>

    </div>
@endsection
