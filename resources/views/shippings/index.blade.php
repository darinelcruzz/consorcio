@extends('admin')

@section('main-content')

    <data-table col="col-md-12" title="Embarques"
        example="example1" color="box-warning">

        <template slot="header">
            <tr>
                <th>#</th>
                <th>Fecha</th>
                <th>Proveedor</th>
                <th>Remisión</th>
                <th>Producto</th>
                <th>Cant/Part</th>
                <th>Precio</th>
                <th>Importe</th>
                <th>Observaciones</th>
            </tr>
        </template>

        <template slot="body">
            @foreach($shippings as $shipping)
                <tr>
                    <td>{{ $shipping->id }}</td>
                    <td>{{ $shipping->short_date }}</td>
                    <td>{{ $shipping->provider }}</td>
                    <td>{{ $shipping->remission }}</td>
                    <td>
                        {{ $shipping->productr->name }}
                        &nbsp;
                        @if ($shipping->productr->name == 'Procesado')
                            <a href="{{ route('shipping.show', ['id' => $shipping->id])}}">
                                <i class="fa fa-eye"></i>
                            </a>
                        @endif
                    </td>
                    <td>{{ $shipping->quantity }}</td>
                    <td>$ {{ number_format($shipping->price, 2) }}</td>
                    <td>$ {{ number_format($shipping->amount, 2) }}</td>
                    <td>{{ $shipping->observations }}</td>
                </tr>
            @endforeach
        </template>

    </data-table>

@endsection
