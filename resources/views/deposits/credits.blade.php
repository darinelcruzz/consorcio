@extends('admin')

@section('main-content')
    <data-table col="col-md-12" title="{{ count($due) }} vencidas ({{ number_format(collect($due)->sum('amount'), 2) }})" example="example1" color="box-danger" collapsed="collapsed-box">
        <template slot="header">
            <tr>
                <th>Folio</th>
                <th style="text-align: center;">Producto</th>
                <th>Cliente</th>
                <th>Venta</th>
                <th>Días</th>
                <th>Vencimiento</th>
                <th style="text-align: right;">Importe</th>
            </tr>
        </template>

        <template slot="body">
            @foreach($due as $sale)
                <tr>
                    <td><b>{{ $sale->series }}</b>{{ substr("00000" . $sale->folio, -5) }}</td>
                    <td style="text-align: center;"><label class="label label-{{ $sale->typeColor }}">{{ strtoupper($sale->type) }}</label></td>
                    <td><a href="{{ route('client.show', $sale->client) }}"> {{ $sale->client->name }}</a></td>
                    <td>{{ $sale->short_date }}</td>
                    <td>{{ $sale->days }}</td>
                    <td>{{ $sale->dueDate }}</td>
                    <td style="text-align: right;">{{ number_format($sale->amount, 2) }}</td>
                </tr>
            @endforeach
        </template>

        <template slot="footer">
            <tr>
                <td colspan="5"></td>
                <th style="text-align: right;"><em><small>TOTAL</small></em></th>
                <td style="text-align: right;">{{ number_format(collect($due)->sum('amount'), 2) }}</td>
            </tr>
        </template>
    </data-table>

    @foreach($products as $product => $sales)

    <data-table col="col-md-12" title="{{ count($sales) . ' de ' . $product }} ({{ number_format($sales->sum('amount'), 2) }})" example="example{{ 2 + $loop->index}}" color="box-{{ $colors[$product] }}" collapsed="collapsed-box">
        <template slot="header">
            <tr>
                <th>Folio</th>
                <th>Cliente</th>
                <th>Venta</th>
                <th>Días</th>
                <th>Vencimiento</th>
                <th style="text-align: right;">Importe</th>
            </tr>
        </template>

        <template slot="body">
            @foreach($sales as $sale)
                <tr>
                    <td><b>{{ $sale->series }}</b>{{ substr("00000" . $sale->folio, -5) }}</td>
                    <td><a href="{{ route('client.show', $sale->client) }}"> {{ $sale->client->name }}</a></td>
                    <td>{{ $sale->short_date }}</td>
                    <td>{{ $sale->days }}</td>
                    <td>{{ $sale->dueDate }}</td>
                    <td style="text-align: right;">{{ number_format($sale->amount, 2) }}</td>
                </tr>
            @endforeach
        </template>

        <template slot="footer">
            <tr>
                <td colspan="4"></td>
                <th style="text-align: right;"><em><small>TOTAL</small></em></th>
                <td style="text-align: right;">{{ number_format($sales->sum('amount'), 2) }}</td>
            </tr>
        </template>
    </data-table>

    @endforeach

@endsection
