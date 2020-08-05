@extends('admin')

@section('main-content')
    <data-table col="col-md-12" title="Vencidas ($ {{ number_format(collect($due)->sum('amount'), 2) }})" example="example1" color="box-danger" collapsed="collapsed-box">
        <template slot="header">
            <tr>
                <th>Folio</th>
                <th>Producto</th>
                <th>Cliente</th>
                <th>Venta</th>
                <th>Días</th>
                <th>Vencimiento</th>
                <th>Importe</th>
            </tr>
        </template>

        <template slot="body">
            @foreach($due as $row)
                <tr>
                    <td><b>{{ $row->series }}</b>{{ substr("00000" . $row->folio, -5) }}</td>
                    <td><label class="label label-{{ $row->typeColor }}">{{ strtoupper($row->type) }}</label></td>
                    <td><a href="{{ route('client.show', $row->client) }}"> {{ $row->client->name }}</a></td>
                    <td>{{ $row->short_date }}</td>
                    <td>{{ $row->days }}</td>
                    <td>{{ $row->dueDate }}</td>
                    <td>{{ $row->nice_amount }}</td>
                </tr>
            @endforeach
        </template>

        <template slot="footer">
            <tr>
                <td colspan="5"></td>
                <th>Total</th>
                <td>$ {{ number_format(collect($due)->sum('amount'), 2) }}</td>
            </tr>
        </template>
    </data-table>

    <data-table col="col-md-12" title="Vivo ($ {{ number_format($alive->where('status', '!=', 'pagado')->sum('amount'), 2) }})" example="example2" color="box-primary" collapsed="collapsed-box">
        <template slot="header">
            <tr>
                <th>Folio</th>
                <th>Cliente</th>
                <th>Venta</th>
                <th>Días</th>
                <th>Vencimiento</th>
                <th>Estado</th>
                <th>Importe</th>
            </tr>
        </template>

        <template slot="body">
            @foreach($alive as $row)
                @if ($row->status != 'pagado')
                    <tr>
                        <td><b>{{ $row->series }}</b>{{ substr("00000" . $row->folio, -5) }}</td>
                        <td><a href="{{ route('client.show', $row->client) }}"> {{ $row->client->name }}</a></td>
                        <td>{{ $row->short_date }}</td>
                        <td>{{ $row->days }}</td>
                        <td>{{ $row->dueDate }}</td>
                        <td><label class="label label-{{ $row->statusColor }}">{{ strtoupper($row->status) }}</label></td>
                        <td>{{ $row->nice_amount }}</td>
                    </tr>
                @endif
            @endforeach
        </template>

        <template slot="footer">
            <tr>
                <td colspan="5"></td>
                <th>Total</th>
                <td>$ {{ number_format($alive->where('status', '!=', 'pagado')->sum('amount'), 2) }}</td>
            </tr>
        </template>
    </data-table>

    <data-table col="col-md-12" title="Fresco ($ {{ number_format($fresh->where('status', '!=', 'pagado')->sum('amount'), 2) }})" example="example3" color="box-warning" collapsed="collapsed-box">
        <template slot="header">
            <tr>
                <th>Folio</th>
                <th>Cliente</th>
                <th>Venta</th>
                <th>Días</th>
                <th>Vencimiento</th>
                <th>Estado</th>
                <th>Importe</th>
            </tr>
        </template>

        <template slot="body">
            @foreach($fresh as $row)
                @if ($row->status != 'pagado')
                    <tr>
                        <td><b>{{ $row->series }}</b>{{ substr("00000" . $row->folio, -5) }}</td>
                        <td><a href="{{ route('client.show', $row->client) }}"> {{ $row->client->name }}</a></td>
                        <td>{{ $row->short_date }}</td>
                        <td>{{ $row->days }}</td>
                        <td>{{ $row->dueDate }}</td>
                        <td><label class="label label-{{ $row->statusColor }}">{{ strtoupper($row->status) }}</label></td>
                        <td>{{ $row->nice_amount }}</td>
                    </tr>
                @endif
            @endforeach
        </template>

        <template slot="footer">
            <tr>
                <td colspan="5"></td>
                <th>Total</th>
                <td>$ {{ number_format($fresh->where('status', '!=', 'pagado')->sum('amount'), 2) }}</td>
            </tr>
        </template>
    </data-table>

    <data-table col="col-md-12" title="Procesado ($ {{ number_format($processed->where('status', '!=', 'pagado')->sum('amount'), 2) }})" example="example4" color="box-success" collapsed="collapsed-box">
        <template slot="header">
            <tr>
                <th>Folio</th>
                <th>Cliente</th>
                <th>Venta</th>
                <th>Días</th>
                <th>Vencimiento</th>
                <th>Estado</th>
                <th>Importe</th>
            </tr>
        </template>

        <template slot="body">
            @foreach($processed as $row)
                @if ($row->status != 'pagado')
                    <tr>
                        <td><b>{{ $row->series }}</b>{{ substr("00000" . $row->folio, -5) }}</td>
                        <td><a href="{{ route('client.show', $row->client) }}"> {{ $row->client->name }}</a></td>
                        <td>{{ $row->short_date }}</td>
                        <td>{{ $row->days }}</td>
                        <td>{{ $row->dueDate }}</td>
                        <td><label class="label label-{{ $row->statusColor }}">{{ strtoupper($row->status) }}</label></td>
                        <td>{{ $row->nice_amount }}</td>
                    </tr>
                @endif
            @endforeach
        </template>

        <template slot="footer">
            <tr>
                <td colspan="5"></td>
                <th>Total</th>
                <td>$ {{ number_format($processed->where('status', '!=', 'pagado')->sum('amount'), 2) }}</td>
            </tr>
        </template>
    </data-table>

    <data-table col="col-md-12" title="Cerdo ($ {{ number_format($pork->where('status', '!=', 'pagado')->sum('amount'), 2) }})" example="example5" color="box-baby" collapsed="collapsed-box">
        <template slot="header">
            <tr>
                <th>Folio</th>
                <th>Cliente</th>
                <th>Venta</th>
                <th>Días</th>
                <th>Vencimiento</th>
                <th>Estado</th>
                <th>Importe</th>
            </tr>
        </template>

        <template slot="body">
            @foreach($pork as $row)
                @if ($row->status != 'pagado')
                    <tr>
                        <td><b>{{ $row->series }}</b>{{ substr("00000" . $row->folio, -5) }}</td>
                        <td><a href="{{ route('client.show', $row->client) }}"> {{ $row->client->name }}</a></td>
                        <td>{{ $row->short_date }}</td>
                        <td>{{ $row->days }}</td>
                        <td>{{ $row->dueDate }}</td>
                        <td><label class="label label-{{ $row->statusColor }}">{{ strtoupper($row->status) }}</label></td>
                        <td>{{ $row->nice_amount }}</td>
                    </tr>
                @endif
            @endforeach
        </template>

        <template slot="footer">
            <tr>
                <td colspan="5"></td>
                <th>Total</th>
                <td>$ {{ number_format($pork->where('status', '!=', 'pagado')->sum('amount'), 2) }}</td>
            </tr>
        </template>
    </data-table>
@endsection
