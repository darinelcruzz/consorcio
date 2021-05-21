@extends('admin')

@section('main-content')

    {!! Form::open(['method' => 'POST', 'route' => 'chart.index']) !!}
        
        <div class="row">
            <div class="col-md-3">
            {!! Field::date('start', $start) !!}
            </div>
            <div class="col-md-3">
            {!! Field::date('end', $end) !!}
            </div>
            <div class="col-md-3">
                {!! Field::select('interval', ['d M' => 'Diario', '\S\e\m\a\n\a W' => 'Semanal', 'M' => 'Mensual', 'Y' => 'Anual'], $interval, ['label' => 'Tiempo', 'empty' => 'Seleccione el intervalo']) !!}
            </div>
            <div class="col-md-3">
                <label for="">&nbsp;</label>
                {!! Form::submit('Generar', ['class' => 'btn btn-warning btn-block']) !!}
            </div>
        </div>
    {!! Form::close() !!}

    <div class="row">
        <div class="col-md-12">
            <solid-box color="box-danger" title="Ventas totales">
                {{ $salesChart->container() }}               
            </solid-box>

            <solid-box color="box-default" title="Kilogramos totales">
                {{ $kgChart->container() }}               
            </solid-box>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/6.0.6/highcharts.js" charset="utf-8"></script> --}}
    {!! $salesChart->script() !!}
    {!! $kgChart->script() !!}

@endsection
