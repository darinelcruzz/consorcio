@extends('admin')

@section('main-content')

    <data-table col="col-md-12" title="Embarques"
        example="example1" color="box-warning">

        <template slot="header">
            <tr>
                <th>#</th>
                <th><i class="fa fa-cogs"></i></th>
                <th>Fecha</th>
                <th>Remisión</th>
                <th>Proveedor</th>
                <th style="text-align: center;"><i class="fa fa-list"></i></th>
                <th style="text-align: center;">Cant/Cajas</th>
                <th>Precio</th>
                <th>Importe</th>
                <th style="width: 25%">Observaciones</th>
            </tr>
        </template>
 
        {{-- {{ drawHeader('#', 'Fecha', 'Remisión', 'Producto', 'Cant/Part', 'Precio', 'Importe', 'Observaciones') }} --}}

        <template slot="body">
            @foreach($shippings as $shipping)
                <tr>
                    <td>{{ $shipping->id }}</td>
                    <td>
                        @include('shippings.options')
                    </td>
                    <td>{{ $shipping->short_date }}</td>
                    <td>{{ $shipping->remission }}</td>
                    <td>{{ $shipping->provider_name }}</td>
                    <td style="text-align: center;">
                        @if ($shipping->productr->name == 'Procesado')
                            <span class="badge bg-green"><em>procesado</em></span>
                        @elseif($shipping->productr->name == 'Cerdo')
                            <span class="badge" style="background-color: #EE76A0;"><em>cerdo</em></span>
                        @else
                            <span class="badge bg-{{ $shipping->badge_color }}"><em>{{ strtolower($shipping->productr->name) }}</em></span>
                        @endif
                    </td>
                    <td style="text-align: center;">{{ $shipping->quantity }}</td>
                    <td>$ {{ number_format($shipping->price, 2) }}</td>
                    <td>$ {{ number_format($shipping->amount, 2) }}</td>
                    <td>{{ $shipping->observations }}</td>
                </tr>
            @endforeach
        </template>

    </data-table>

@endsection
