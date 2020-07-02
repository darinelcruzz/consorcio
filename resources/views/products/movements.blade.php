@extends('admin')

@section('main-content')


    <div class="row">
        <div class="col-md-9">
            <solid-box title="Elegir fecha" color="box-warning">
                {!! Form::open(['method' => 'POST', 'route' => 'movement.index']) !!}
                    <div class="row">
                        <div class="col-md-4">
                            {!! Field::date('from', $from, ['label' => 'De :']) !!}
                        </div>
                        <div class="col-md-4">
                            {!! Field::date('to', $to, ['label' => 'A :']) !!}
                        </div>
                        <div class="col-md-4">
                            <label for="dd"></label><br>
                            {!! Form::submit('Buscar', ['class' => 'btn btn-warning btn-block']) !!}
                        </div>
                    </div>
                {!! Form::close() !!}
            </solid-box>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            
            <solid-box title="Movimientos" color="box-warning">
                <table id="example1" class="table table-striped table-bordered">                    
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Producto</th>
                            <th>Folio | Remisión</th>
                            <th>Operación</th>
                            <th>Cantidad</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($adjustments as $adjustment)
                            <tr>
                                <td>{{ fdate($adjustment->date, 'Y-m-d') }}</td>
                                <td>{{ $adjustment->product->name }}</td>
                                <td>N/A</td>
                                <td><label class="label label-warning"><em>AJUSTE</em></label></td>
                                <td>{{ $adjustment->quantity - $adjustment->before > 0 ? '+': '' }}{{ $adjustment->quantity - $adjustment->before}}</td>
                            </tr>
                        @endforeach

                        @foreach($pork as $sale)
                            <tr>
                                <td>{{ $sale->date }}</td>
                                <td>Cerdo</td>
                                <td>{{ $sale->folio }}</td>
                                <td><label class="label label-danger"><em>SALIDA</em></label></td>
                                <td>-{{ $sale->quantity }}</td>
                            </tr>
                        @endforeach

                        @foreach($fresh as $sale)
                            <tr>
                                <td>{{ $sale->date }}</td>
                                <td>Pollo fresco</td>
                                <td>{{ $sale->folio }}</td>
                                <td><label class="label label-danger"><em>SALIDA</em></label></td>
                                <td>-{{ $sale->quantity }}</td>
                            </tr>
                        @endforeach

                        @foreach($alive as $sale)
                            <tr>
                                <td>{{ $sale->date }}</td>
                                <td>Pollo vivo</td>
                                <td>{{ $sale->folio }}</td>
                                <td><label class="label label-danger"><em>SALIDA</em></label></td>
                                <td>-{{ $sale->quantity }}</td>
                            </tr>
                        @endforeach

                        @foreach($processed as $sale)
                            <tr>
                                <td>{{ $sale['date'] }}</td>
                                <td>{{ $sale['product'] }}</td>
                                <td>{{ $sale['folio'] }}</td>
                                <td><label class="label label-danger"><em>SALIDA</em></label></td>
                                <td>-{{ $sale['quantity'] }}</td>
                            </tr>
                        @endforeach

                        @foreach($shippings as $shipping)
                            <tr>
                                <td>{{ $shipping->date }}</td>
                                <td>{{ $shipping->productr->name }}</td>
                                <td>{{ $shipping->remission }}</td>
                                <td><label class="label label-success"><em>ENTRADA</em></label></td>
                                <td>+{{ $shipping->quantity }}</td>
                            </tr>
                        @endforeach

                        @foreach($processed_sh as $shipping)
                            <tr>
                                <td>{{ $shipping['date'] }}</td>
                                <td>{{ $shipping['product'] }}</td>
                                <td>{{ $shipping['folio'] }}</td>
                                <td><label class="label label-success"><em>ENTRADA</em></label></td>
                                <td>+{{ $shipping['quantity'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </solid-box>
        </div>
    </div>

@endsection
