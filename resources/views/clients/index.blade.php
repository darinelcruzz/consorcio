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
                    <td>
                        <a href="{{ route('client.details', ['id' => $client->id])}}">{{ $client->name }}</a> &nbsp;
                        <a href="{{ route('client.edit', ['id' => $client->id])}}"
                            title="EDITAR">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                        </a><br>
                        {{ $client->email }} <br>
                        {{ $client->phone }} <br>
                        {{ $client->cellphone or ''}}
                    </td>
                    <td>{{ $client->rfc }}</td>
                    <td>{{ $client->address }}</td>
                    <td>
                        @foreach (unserialize($client->products) as $product)
                            @if (!$loop->last)
                                {{ $product }},
                            @else
                                {{ $product }}
                            @endif
                        @endforeach
                        <br>
                        Credito: {{ $client->credit == 1 ? 'Si Max: ' .  $client->notes  . ' Días ' . $client->days : 'No' }} 
                    </td>
                </tr>
            @endforeach
        </template>

    </data-table>

@endsection
