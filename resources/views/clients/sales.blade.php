<data-table col="col-md-12" title="{{ $type }}" example="example{{ $example }}" color="box-{{ $color }}" collapsed="collapsed-box">

    <template slot="header">
        <tr>
            <th>ID</th>
            <th>Fecha</th>
            <th>Kg</th>
            <th>Precio</th>
            <th>Importe</th>
            <th>Estado</th>
        </tr>
    </template>

    <template slot="body">
        @foreach($client->$sale as $sale)
            <tr>
                <td>{{ $sale->id }}</td>
                <td>{{ $sale->date }}</td>
                <td>{{ $sale->kg }}</td>
                <td>{{ $sale->price }}</td>
                <td>{{ $sale->amount }}</td>
                <td>{{ $sale->status }}</td>
            </tr>
        @endforeach
    </template>

</data-table>
