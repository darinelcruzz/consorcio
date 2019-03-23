@extends('admin')

@section('main-content')

    <div class="row">
        <div class="col-md-7">
            <solid-box title="Venta {{ $sale->series . substr("00000" . $sale->folio, -5) }} de {{ $type }} por $ {{ $amount }}" color="box-success">

                <h4 align="center">Abonos</h4>
                <table class="table table-striped table-bordered table-condensed table-hover table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Importe</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($deposits as $deposit)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $deposit->nice_amount }}</td>
                                <td>{{ $deposit->short_date }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <br>

                @if($sale->products)
                    <h4 align="center">Productos</h4>
                    <table class="table table-striped table-bordered table-condensed table-hover table">
                        <thead>
                            <tr>
                                <th>Descripción</th>
                                <th>Cajas</th>
                                <th>Pollos</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach(unserialize($sale->products) as $product)
                                <tr>
                                    <td>{{ App\Product::find($product['i'])->name }}</td>
                                    <td>{{ $product['b'] }}</td>
                                    <td>{{ $product['q'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </solid-box>
        </div>
    </div>

@endsection
