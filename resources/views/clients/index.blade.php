@extends('admin')

@section('main-content')

    <data-table col="col-md-12" title="Clientes"
        example="example1" color="box-warning">

        <template slot="header">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>R.F.C.</th>
                <th>Dirección</th>
                <th>Productos</th>
            </tr>
        </template>

        <template slot="body">
            @foreach($clients as $client)
                <tr>
                    <td>{{ $client->id }}</td>
                    
                </tr>
            @endforeach
        </template>

    </data-table>

@endsection
