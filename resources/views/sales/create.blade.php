@extends('admin')

@section('main-content')

    <div class="row">

        <div class="col-md-6">

            <solid-box title="Introduzca los datos de la venta"
                color="{{ 'box-' . $color }}">
                {!! Form::open(['method' => 'POST', 'route' => $type . '.store']) !!}
                    {!! Field::select('client_id', $clients, null,
                        ['label' => 'Cliente', 'v-model' => 'client_id',
                        'tpl' => 'templates/withicon', 'empty' => 'Seleccione un cliente'],
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

        <div class="col-md-6">

            <client-info :clients="clients" :client="client_id"></client-info>

            <div class="box box-solid">
                <div class="box-header with-border">
                  <i class="fa fa-shopping-cart"></i>

                  <h3 class="box-title">Última venta hecha</h3>
                </div><!-- /.box-header -->

                <div class="box-body">
                  <dl class="dl-horizontal">
                    <dt>Folio</dt>
                    <dd>1000123</dd>
                    <dt>Fecha</dt>
                    <dd>Lunes 17 de julio, 2017</dd>
                    <dt>Cliente</dt>
                    <dd>Fulano de Tal</dd>
                    <dt>Precio</dt>
                    <dd>$ 20.00</dd>
                    <dt>Cantidad</dt>
                    <dd>10.5 kg</dd>
                    <dt>Importe</dt>
                    <dd>$ 210.00</dd>
                  </dl>
                </div><!-- /.box-body -->
            </div><!-- /.box -->

        </div>

    </div>

@endsection
