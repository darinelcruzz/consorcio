@extends('admin')

@section('main-content')

    <div class="row">
        <div class="col-md-6">
            <solid-box title="Venta # {{ $processedsale->id }}" color="box-success">

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Cajas</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach (unserialize($processedsale->products) as $product)
                            <tr>
                                <td>{{ App\Product::find($product['i'])->name }}</td>
                                <td>{{ '$ ' . number_format($product['p'], 2) }}</td>
                                <td>{{ $product['q'] }}</td>
                                <td>{{ $product['b'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </solid-box>
        </div>
    </div>

@endsection
