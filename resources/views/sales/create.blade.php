@extends('admin')

@section('main-content')

    <div class="row">

        <div class="col-md-6">

            <solid-box title="Introduzca los datos de la venta"
                color="box-{{ $color }}">
                {!! Form::open(['method' => 'POST', 'route' => $type . '.store']) !!}
                    {!! Field::select('client_id', $clients, null,
                        ['tpl' => 'templates/withicon', 'empty' => 'Seleccione un cliente', 'v-model' => 'client_id'],
                        ['icon' => 'user'])
                    !!}
                    <div class="row">
                        <div class="col-md-6">
                            {!! Field::number('folio', $lastSale ? $lastSale->folio + 1: 1,
                                ['disabled' => '', 'tpl' => 'templates/withicon'],
                                ['icon' => 'barcode'])
                            !!}
                        </div>

                        <div class="col-md-6">
                            {!! Field::select('date', $validDates, null,
                                ['tpl' => 'templates/withicon', 'empty' => 'Seleccione la fecha'],
                                ['icon' => 'calendar'])
                            !!}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            {!! Field::number('quantity', ['tpl' => 'templates/withicon', 'step' => '0.01'],
                                ['icon' => 'list-ol']) !!}
                        </div>

                        <div class="col-md-6">
                            {!! Field::number('kg', ['tpl' => 'templates/withicon', 'step' => '0.01'],
                                ['icon' => 'balance-scale']) !!}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            {!! Field::select('price', $prices->toArray(), null,
                                ['tpl' => 'templates/withicon','empty' => 'Seleccione un precio', 'v-model' => 'price_id'],
                                ['icon' => 'money'])
                            !!}
                        </div>

                        <div class="col-md-6">
                            {!! Field::number('amount', ['tpl' => 'templates/withicon', 'step' => '0.01'],
                                ['icon' => 'usd']) !!}
                        </div>
                    </div>

                    <div v-if="clients[client_id]" class="row">
                        <div v-if="clients[client_id].notes > 0"  class="col-md-6">
                            {!! Field::select('credit', ['No', 'Semanal', 'Quince días'], null,
                                ['tpl' => 'templates/withicon','empty' => '¿Se vende a crédito?'],
                                ['icon' => 'credit-card-alt'])
                                !!}
                        </div>
                        <input v-else type="hidden" name="credit" value="0">
                    </div>

                    @if ($type == 'processed')
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
                    @endif

                    <input type="hidden" name="folio" value="{{ $lastSale ? $lastSale->folio + 1: 1 }}">
                    <input type="hidden" name="days" value="0">
                    <input type="hidden" name="status" value="pagado">
                    {!! Form::submit('Agregar', ['class' => 'btn btn-' . $color . ' pull-right']) !!}

                {!! Form::close() !!}
            </solid-box>

        </div>

        <div class="col-md-6">

            <client-info :clients="clients" :client="client_id"></client-info>

            @if ($lastSale)
                <div class="box box-solid">
                    <div class="box-header with-border">
                      <i class="fa fa-shopping-cart"></i>

                      <h3 class="box-title">Última venta hecha</h3>
                    </div><!-- /.box-header -->

                    <div class="box-body">
                      <dl class="dl-horizontal">
                        <dt>Cliente</dt>
                        <dd>{{ $lastSale->client->name }}</dd>
                        <dt>Folio</dt>
                        <dd>{{ $lastSale->id }}</dd>
                        <dt>Fecha</dt>
                        <dd>{{ $lastSale->date }}</dd>
                        <dt>Precio</dt>
                        <dd>{{ $lastSale->price }}</dd>
                        <dt>Cantidad</dt>
                        <dd>{{ $lastSale->quantity }}</dd>
                        <dt>Importe</dt>
                        <dd>$ {{ $lastSale->amount }}</dd>
                      </dl>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            @endif

        </div>

    </div>
@endsection
