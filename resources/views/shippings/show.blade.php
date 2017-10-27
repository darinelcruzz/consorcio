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
                            <th>Cajas</th>
                            <th>Importe</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach (unserialize($shipping->processed) as $product)
                            <tr>
                                <td>{{ App\Product::find($product['i'])->name }}</td>
                                <td>{{ '$ ' . number_format($product['p'], 2) }}</td>
                                <td>{{ $product['q'] }}</td>
                                <td>{{ $product['t'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </solid-box>
        </div>
    </div>

@endsection
