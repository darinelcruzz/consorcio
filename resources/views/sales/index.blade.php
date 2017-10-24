@extends('admin')

@section('main-content')

    <row-woc col="col-md-12">
        <a href="{{ route($type . '.create') }}" class="btn btn-app">
            <span class="badge bg-red">+</span>
            <i class="fa fa-shopping-cart"></i> Nueva venta
        </a>
    </row-woc>

    <data-table col="col-md-12" title="{{ $types[$type] }}"
        example="example1" color="{{ 'box-' . $color }}">

        <template slot="header">
            <tr>
                <th>Folio</th>
                <th>Fecha</th>
                <th>Cliente</th>
                <th>Cantidad</th>
                <th>Kg</th>
                <th>Precio</th>
                <th>Importe</th>
                <th>Crédito</th>
                <th>Estado</th>
            </tr>
        </template>

        <template slot="body">
            @foreach($sales as $sale)
                <tr>
                    <td>{{ $sale->folio }}</td>
                    <td>{{ $sale->shortDate }}</td>
                    <td>{{ $sale->client->name }}</td>
                    <td>{{ $sale->quantity }}</td>
                    <td>{{ $sale->kg }}</td>
                    <td>{{ $sale->pricer->name }}</td>
                    <td>{{ $sale->niceAmount }}</td>
                    <td>{{ $sale->credit }}</td>
                    <td>{{ $sale->status }}</td>
                </tr>
            @endforeach
        </template>

    </data-table>

@endsection
