@extends('admin')

@section('main-content')
    <data-table col="col-md-12" title="Vencidas" example="example1" color="box-danger" collapsed="collapsed-box">
        <template slot="header">
            <tr>
                <th>Folio</th>
                <th>Producto</th>
                <th>Cliente</th>
                <th>Importe</th>
                <th>Venta</th>
                <th>Días</th>
                <th>Vencimiento</th>
                <th>Estado</th>
            </tr>
        </template>

        <template slot="body">
            @foreach($due as $row)
                <tr>
                    <td>{{ $row->id }}</td>
                    <td>{{ $row->type }}</td>
                    <td>{{ $row->client->name }}</td>
                    <td>{{ $row->niceAmount }}</td>
                    <td>{{ $row->shortDate }}</td>
                    <td>{{ $row->days }}</td>
                    <td>{{ $row->dueDate }}</td>
                    <td>{{ $row->status }}</td>
                </tr>
            @endforeach
        </template>
    </data-table>

    <data-table col="col-md-12" title="Vivo" example="example2" color="box-primary" collapsed="collapsed-box">
        <template slot="header">
            <tr>
                <th>Folio</th>
                <th>Cliente</th>
                <th>Importe</th>
                <th>Venta</th>
                <th>Días</th>
                <th>Vencimiento</th>
                <th>Estado</th>
            </tr>
        </template>

        <template slot="body">
            @foreach($alive as $row)
                @if ($row->status != 'pagado')
                    <tr>
                        <td>{{ $row->id }}</td>
                        <td>{{ $row->client->name }}</td>
                        <td>{{ $row->niceAmount }}</td>
                        <td>{{ $row->shortDate }}</td>
                        <td>{{ $row->days }}</td>
                        <td>{{ $row->dueDate }}</td>
                        <td>{{ $row->status }}</td>
                    </tr>
                @endif
            @endforeach
        </template>
    </data-table>

    <data-table col="col-md-12" title="Fresco" example="example3" color="box-warning" collapsed="collapsed-box">
        <template slot="header">
            <tr>
                <th>Folio</th>
                <th>Cliente</th>
                <th>Importe</th>
                <th>Venta</th>
                <th>Días</th>
                <th>Vencimiento</th>
                <th>Estado</th>
            </tr>
        </template>

        <template slot="body">
            @foreach($fresh as $row)
                @if ($row->status != 'pagado')
                    <tr>
                        <td>{{ $row->id }}</td>
                        <td>{{ $row->client->name }}</td>
                        <td>{{ $row->niceAmount }}</td>
                        <td>{{ $row->shortDate }}</td>
                        <td>{{ $row->days }}</td>
                        <td>{{ $row->dueDate }}</td>
                        <td>{{ $row->status }}</td>
                    </tr>
                @endif
            @endforeach
        </template>
    </data-table>

    <data-table col="col-md-12" title="Procesado" example="example4" color="box-success" collapsed="collapsed-box">
        <template slot="header">
            <tr>
                <th>Folio</th>
                <th>Cliente</th>
                <th>Importe</th>
                <th>Venta</th>
                <th>Días</th>
                <th>Vencimiento</th>
                <th>Estado</th>
            </tr>
        </template>

        <template slot="body">
            @foreach($processed as $row)
                @if ($row->status != 'pagado')
                    <tr>
                        <td>{{ $row->id }}</td>
                        <td>{{ $row->client->name }}</td>
                        <td>{{ $row->niceAmount }}</td>
                        <td>{{ $row->shortDate }}</td>
                        <td>{{ $row->days }}</td>
                        <td>{{ $row->dueDate }}</td>
                        <td>{{ $row->status }}</td>
                    </tr>
                @endif
            @endforeach
        </template>
    </data-table>

    <data-table col="col-md-12" title="Cerdo" example="example5" color="box-baby" collapsed="collapsed-box">
        <template slot="header">
            <tr>
                <th>Folio</th>
                <th>Cliente</th>
                <th>Importe</th>
                <th>Venta</th>
                <th>Días</th>
                <th>Vencimiento</th>
                <th>Estado</th>
            </tr>
        </template>

        <template slot="body">
            @foreach($pork as $row)
                @if ($row->status != 'pagado')
                    <tr>
                        <td>{{ $row->id }}</td>
                        <td>{{ $row->client->name }}</td>
                        <td>{{ $row->niceAmount }}</td>
                        <td>{{ $row->shortDate }}</td>
                        <td>{{ $row->days }}</td>
                        <td>{{ $row->dueDate }}</td>
                        <td>{{ $row->status }}</td>
                    </tr>
                @endif
            @endforeach
        </template>
    </data-table>
@endsection
