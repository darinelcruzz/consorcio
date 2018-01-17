@extends('admin')

@section('main-content')

<div class="row">
    <div class="col-md-6">
        <solid-box title="Por Cliente" color="box-success"  collapsed="collapsed-box">
            {!! Form::open(['method' => 'POST', 'route' => 'report.client']) !!}
                <div class="row">
                    <div class="col-md-6">
                        {!! Field::date('startDate', $date) !!}
                    </div>
                    <div class="col-md-6">
                        {!! Field::date('endDate', $date) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        {!! Field::select('client_id', $clients->toArray(), null,
                            ['tpl' => 'templates/withicon', 'empty' => 'Seleccione un cliente'],
                            ['icon' => 'user'])
                        !!}
                    </div>
                </div>
                <div class="box-footer">
                    {!! Form::submit('Generar', ['class' => 'btn btn-black btn-block']) !!}
                </div>
            {!! Form::close() !!}
        </solid-box>

        <solid-box title="De Ventas" color="box-success"  collapsed="collapsed-box">
            {!! Form::open(['method' => 'POST', 'route' => 'report.sales']) !!}
            <div class="row">
                <div class="col-md-6">
                    {!! Field::date('startDate', $date) !!}
                </div>
                <div class="col-md-6">
                    {!! Field::date('endDate', $date) !!}
                </div>
            </div>
            <div class="box-footer">
                {!! Form::submit('Generar', ['class' => 'btn btn-black btn-block']) !!}
            </div>
            {!! Form::close() !!}
        </solid-box>
    </div>
    <div class="col-md-6">
            <solid-box title="Por Producto" color="box-success"  collapsed="collapsed-box">
                {!! Form::open(['method' => 'POST', 'route' => 'report.product']) !!}
                    <div class="row">
                        <div class="col-md-6">
                            {!! Field::date('startDate', $date) !!}
                        </div>
                        <div class="col-md-6">
                            {!! Field::date('endDate', $date) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            {!! Field::select('product_id',
                                ['2' => 'Fresco', '3' => 'Vivo', '4' => 'Rangos', '5' => 'Cortes*', '1' => 'Cerdo' ], 
                                null, ['tpl' => 'templates/withicon', 'empty' => 'Seleccione un producto'],
                                ['icon' => 'list'])
                            !!}
                        </div>
                    </div>
                    <div class="box-footer">
                        {!! Form::submit('Generar', ['class' => 'btn btn-black btn-block']) !!}
                    </div>
                {!! Form::close() !!}
            </solid-box>
            <solid-box title="De Embarques" color="box-success"  collapsed="collapsed-box">
                {!! Form::open(['method' => 'POST', 'route' => 'report.shippings']) !!}
                    <div class="row">
                        <div class="col-md-6">
                            {!! Field::date('startDate', $date) !!}
                        </div>
                        <div class="col-md-6">
                            {!! Field::date('endDate', $date) !!}
                        </div>
                    </div>
                    <div class="box-footer">
                        {!! Form::submit('Generar', ['class' => 'btn btn-black btn-block']) !!}
                    </div>
                {!! Form::close() !!}
            </solid-box>
    </div>
</div>

@endsection
