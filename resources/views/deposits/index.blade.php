@extends('admin')

@section('main-content')
    <data-table col="col-md-12" title="Abonos" example="example1" color="box-success">
        <template slot="header">
            <tr>
                <th>ID</th>
                <th>Folio</th>
                <th>Producto</th>
                <th>Cliente</th>
                <th>Importe</th>
                <th>Fecha</th>
            </tr>
        </template>

        <template slot="body">
            @foreach($deposits as $row)
                <tr>
                    <td>{{ $row->id }}</td>
                    <td>{{ $row->sale_id }}</td>
                    <td>{{ $row->type }}</td>
                    <td><a href="{{ route('client.show', ['id' => $row->client->id]) }}">{{ $row->client->name }}</a></td>
                    <td>{{ $row->nice_amount }}</td>
                    <td>{{ $row->short_date }}</td>
                </tr>
            @endforeach
        </template>
    </data-table>

@endsection
