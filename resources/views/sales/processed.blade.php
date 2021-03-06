@extends('admin')

@section('main-content')

    <div class="row">
        <div class="col-md-6">
            <solid-box title="Venta con folio {{ $processedsale->folio }}" color="box-success">

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Kg</th>
                            <th>Cajas</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach (unserialize($processedsale->products) as $product)
                            <tr>
                                <td>{{ App\Product::find($product['i'])->name }}</td>
                                <td>{{ '$ ' . number_format($product['p'], 2) }}</td>
                                <td>{{ $product['q'] }}</td>
                                <td>{{ $product['k'] or 0 }}</td>
                                <td>{{ $product['b'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </solid-box>
        </div>

        <div class="col-md-6">
            <a href="{{ route('processed.editKg', $processedsale) }}"
                class="btn btn-success">
                <i class="fa fa-pencil"></i>&nbsp;&nbsp;
                Editar (kg o $)
            </a>

            <br><br><br>

            <a href="{{ route('processed.editProducts', $processedsale) }}"
                class="btn btn-warning">
                <i class="fa fa-pencil"></i>&nbsp;&nbsp;
                Editar productos
            </a>

            <br><br><br>
            <a href="{{ route('processed.index') }}"
                class="btn btn-danger">
                <i class="fa fa-backward"></i>
                Regresar
            </a>
        </div>
    </div>

@endsection
