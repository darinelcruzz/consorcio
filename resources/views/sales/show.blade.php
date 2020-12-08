@extends('admin')

@section('main-content')

    <div class="row">
        <div class="col-md-6">

            <solid-box title="Venta #{{ $sale->series }}{{ $sale->folio }} de {{ $sale->client->name }}" color="box-{{ $color }}">

                <div class="row">
                    <div class="col-md-6">
                        {!! Field::text('client_id', $sale->client->name, ['tpl' => 'templates/withicon', 'disabled' => 'true'], ['icon' => 'user']) !!}
                    </div>
                    <div class="col-md-6">
                        {!! Field::text('folio', $sale->series . $sale->folio, ['tpl' => 'templates/withicon', 'disabled' => 'true'], ['icon' => 'barcode']) !!}
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        {!! Field::text('date', $sale->date, ['tpl' => 'templates/withicon', 'disabled' => 'true'], ['icon' => 'calendar']) !!}
                    </div>
                    <div class="col-md-6">
                        {!! Field::select('price', $prices->toArray(), $sale->price, ['tpl' => 'templates/withicon', 'disabled' => 'true'],
                            ['icon' => 'money'])
                        !!}
                    </div>
                </div>

                {!! Field::text('observations', $sale->observations, ['tpl' => 'templates/withicon', 'disabled' => 'true'], ['icon' => 'comments']) !!}

                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Corte/Rango</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Kg</th>
                            <th>Cajas</th>
                            <th>Importe</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($sale->movements as $movement)
                            <tr>
                                <td>{{ $movement->product->name }}</td>
                                <td style="text-align: center;">{{ number_format($movement->price, 2) }}</td>
                                <td style="text-align: center;">{{ $movement->quantity }}</td>
                                <td style="text-align: center;">{{ $movement->kg }}</td>
                                <td style="text-align: center;">{{ $movement->boxes }}</td>
                                <td style="text-align: center;">{{ number_format($movement->price * $movement->kg, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>

                    <tfoot>
                        <tr>
                            <th></th>
                            <th><small>TOTAL</small></th>
                            <th style="text-align: center;">{{ $sale->movements->sum('quantity') }}</th>
                            <th style="text-align: center;">{{ $sale->movements->sum('kg') }}</th>
                            <th style="text-align: center;">{{ $sale->movements->sum('boxes') }}</th>
                            <th style="text-align: center;">{{ number_format($sale->amount, 2) }}</th>
                        </tr>
                    </tfoot>
                </table>

            </solid-box>

            <a href="{{ route('sale.index', $type) }}" class="btn btn-danger">
                <i class="fa fa-arrow-left"></i> &nbsp;&nbsp;&nbsp; REGRESAR
            </a>

            <a href="{{ route('sale.edit', [$type, $sale->id]) }}" class="btn btn-{{ $color }} pull-right">
                <i class="fa fa-pencil"></i> &nbsp;&nbsp;&nbsp; EDITAR
            </a>

        </div>
    </div>

@endsection
