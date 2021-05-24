@extends('admin')

@section('main-content')

<div class="row">
    <div class="col-md-6">
        <solid-box title="Por Cliente" color="box-success"  collapsed="collapsed-box">
            {!! Form::open(['method' => 'POST', 'route' => 'report.client']) !!}
                <div class="row">
                    <div class="col-md-6">
                        {!! Field::date('start', $date, ['tpl' => 'templates/withicon'], ['icon' => 'calendar']) !!}
                    </div>
                    <div class="col-md-6">
                        {!! Field::date('end', $date, ['tpl' => 'templates/withicon'], ['icon' => 'calendar-o']) !!}
                    </div>
                </div>

                {!! Field::select('client_id', $clients->toArray(), null,
                    ['tpl' => 'templates/withicon', 'empty' => 'Seleccione un cliente'],
                    ['icon' => 'user'])
                !!}

                {!! Form::submit('Generar', ['class' => 'btn btn-success btn-block']) !!}

            {!! Form::close() !!}
        </solid-box>

        <solid-box title="Formato calendario" color="box-warning"  collapsed="collapsed-box">
            {!! Form::open(['method' => 'POST', 'route' => 'report.monthly']) !!}
                {!! Field::select('client_id', ['0' => 'Todas las ventas'] + $clients->toArray(), null,
                    ['tpl' => 'templates/withicon', 'empty' => 'Seleccione un cliente'],
                    ['icon' => 'user'])
                !!}
                <div class="form-group">
                    <label style="font-weight: bold;">Mes</label>

                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input name="month" type="month" class="form-control pull-right" value="{{ date('Y-m') }}">
                    </div>
                </div>
            <div class="box-footer">
                {!! Form::submit('Generar', ['class' => 'btn btn-warning btn-block']) !!}
            </div>
            {!! Form::close() !!}
        </solid-box>

        <solid-box title="De Ventas" color="box-success"  collapsed="collapsed-box">
            {!! Form::open(['method' => 'POST', 'route' => 'report.sales']) !!}
            <div class="row">
                <div class="col-md-6">
                    {!! Field::date('start', $date) !!}
                </div>
                <div class="col-md-6">
                    {!! Field::date('end', $date) !!}
                </div>
            </div>
            <div class="box-footer">
                {!! Form::submit('Generar', ['class' => 'btn btn-success btn-block']) !!}
            </div>
            {!! Form::close() !!}
        </solid-box>

    </div>
    <div class="col-md-6">
            <solid-box title="Por Producto" color="box-warning"  collapsed="collapsed-box">
                {!! Form::open(['method' => 'POST', 'route' => 'report.product']) !!}
                    <div class="row">
                        <div class="col-md-6">
                            {!! Field::date('start', $date) !!}
                        </div>
                        <div class="col-md-6">
                            {!! Field::date('end', $date) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            {!! Field::select('product_id',
                                ['2' => 'Fresco', '3' => 'Vivo', '4' => 'Rangos', '5' => 'Cortes', '1' => 'Cerdo' ], 
                                null, ['tpl' => 'templates/withicon', 'empty' => 'Seleccione un producto'],
                                ['icon' => 'list'])
                            !!}
                        </div>
                    </div>
                    <div class="box-footer">
                        {!! Form::submit('Generar', ['class' => 'btn btn-warning btn-block']) !!}
                    </div>
                {!! Form::close() !!}
            </solid-box>

            <solid-box title="Contabilidad" color="box-success"  collapsed="collapsed-box">
                {!! Form::open(['method' => 'POST', 'route' => 'report.prices']) !!}
                    {!! Field::select('type', ['ventas' => 'De ventas', 'compras' => 'De compras'], 'ventas', ['empty' => 'Seleccione el reporte']) !!}
                    <div class="row">
                        <div class="col-md-6">
                            {!! Field::date('start', $date) !!}
                        </div>
                        <div class="col-md-6">
                            {!! Field::date('end', $date) !!}
                        </div>
                    </div>
                    <div class="box-footer">
                        {!! Form::submit('Generar', ['class' => 'btn btn-success btn-block']) !!}
                    </div>
                {!! Form::close() !!}
            </solid-box>

            <solid-box title="Cobranza" color="box-warning"  collapsed="collapsed-box">
                {!! Form::open(['method' => 'POST', 'route' => 'report.debt']) !!}
                    {!! Field::select('product', 
                        ['cerdo' => 'Cerdo', 'vivo' => 'Pollo vivo y fresco', 'procesado' => 'Pollo procesado'],
                        'cerdo', 
                        ['empty' => 'Seleccione el producto', 'v-model' => 'shipp'])
                    !!}

                    <div v-if="shipp == 'cerdo' || shipp == ''" class="form-group">
                    {!! Field::select('clientes[]', $pork, null, 
                        ['label' => 'Clientes cerdo', 'empty' => 'Seleccione el producto', 'multiple' => 'multiple', 'class' => 'form-control select2', 'style' => 'width: 100%; color: black;'])
                    !!}
                    </div>

                    <div v-else-if="shipp == 'vivo'" class="form-group">
                    {!! Field::select('clientes[]', $alive, null, 
                        ['label' => 'Clientes vivo', 'empty' => 'Seleccione el producto', 'multiple' => 'multiple', 'class' => 'form-control select2', 'style' => 'width: 100%; color: black;'])
                    !!}
                    </div>

                    <div v-else-if="shipp == 'procesado'" class="form-group">
                    {!! Field::select('clientes[]', $processed, null, 
                        ['label' => 'Clientes procesado', 'empty' => 'Seleccione el producto', 'multiple' => 'multiple', 'class' => 'form-control select2', 'style' => 'width: 100%; color: black;'])
                    !!}
                    </div>

                    <div v-else>
                        <code>Elige un producto/s</code>
                    </div>

                    <div class="box-footer">
                        {!! Form::submit('Generar', ['class' => 'btn btn-warning btn-block']) !!}
                    </div>
                {!! Form::close() !!}
            </solid-box>
    </div>
</div>

@endsection
