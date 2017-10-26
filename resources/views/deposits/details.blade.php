@extends('admin')

@section('main-content')
    <data-table col="col-md-8" title="Abonos realizados a Folio {{ $id }} de {{ $type }} por $ {{ $amount }}" example="example1" color="box-success">
        <template slot="header">
            <tr>
                <th>ID</th>
                <th>Importe</th>
                <th>Fecha</th>
            </tr>
        </template>

        <template slot="body">
            @foreach($deposits as $row)
                <tr>
                    <td>{{ $row->id }}</td>
                    <td>{{ $row->nice_amount }}</td>
                    <td>{{ $row->short_date }}</td>
                </tr>
            @endforeach
        </template>
    </data-table>

@endsection
