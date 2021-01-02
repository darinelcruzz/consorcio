@extends('admin')

@section('main-content')

    <div class="row">
        <div class="col-md-6">
            <solid-box title="Embarque # {{ $shipping->id }}" color="box-warning">

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Pollos/Cajas</th>
                            <th>Kg</th>
                            <th>Importe</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($shipping->movements as $movement)
                            <tr>
                                <td>{{ $movement->product->name }}</td>
                                <td>{{ number_format($movement->price, 2) }}</td>
                                <td>{{ $movement->quantity }}</td>
                                <td>{{ $movement->kg }}</td>
                                <td style="text-align: right;">{{ number_format($movement->price * $movement->kg, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>

                    <tfoot>
                        <tr>
                            <th></th>
                            <th>Totales</th>
                            <th>{{ $shipping->movements->sum('quantity') }}</th>
                            <th>{{ $shipping->movements->sum('kg') }}</th>
                            <th style="text-align: right;">{{ number_format($shipping->movements->sum(function ($m) { return $m->price * $m->kg;}), 2) }}</th>
                        </tr>
                    </tfoot>
                </table>

            </solid-box>
        </div>
    </div>

@endsection
