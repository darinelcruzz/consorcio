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
                <th>Observaciones</th>
            </tr>
        </template>

        <template slot="body">
            @foreach($sales as $sale)
                <tr>
                    <td>
                        {{ $sale->folio }}
                        @if ($sale->type == 'procesado')
                            <a href="{{ route('processed.show', ['id' => $sale->id])}}">
                                <i class="fa fa-eye"></i>
                            </a>
                        @endif
                    </td>
                    <td>{{ $sale->shortDate }}</td>
                    <td>
                        @if ($sale->client_id)
                            <a href="{{ route('client.details', ['id' => $sale->client->id]) }}">{{ $sale->client->name }}</a>
                        @else
                            N/A
                        @endif
                    </td>
                    <td>{{ $sale->quantity }}</td>
                    <td>{{ $sale->kg }}</td>
                    <td>{{ $sale->pricer->name or '' }}</td>
                    <td>{{ $sale->niceAmount }}</td>
                    <td>{{ $sale->credit ? "$sale->days días": 'NO'}}</td>
                    <td>{{ $sale->status }}</td>
                    <td>{{ $sale->observations }}</td>
                </tr>
            @endforeach
        </template>

    </data-table>

@endsection
