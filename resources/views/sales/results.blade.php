@extends('admin')

@section('main-content')

    <div class="row">
        <div class="col-md-6">
            <a href="{{ route($type . '.create') }}" class="btn btn-app">
                <span class="badge bg-red">+</span>
                <i class="fa fa-shopping-cart"></i> Nueva venta
            </a>
            <a href="{{ route($type . '.index') }}" class="btn btn-app">
                <span class="badge bg-red"><i class="fa fa-bars"></i></span>
                <i class="fa fa-home"></i> Inicio
            </a>
        </div>
        <div class="col-md-6">
            <br>
            {!! Form::open(['method' => 'POST', 'route' => "$type.search"]) !!}
                <div class="input-group input-group-sm">
                    <input type="text" name="folio" class="form-control">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-{{ $color }} btn-flat">
                          <i class="fa fa-search"></i>
                      </button>
                    </span>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
    <br>
    <data-table col="col-md-12" title="{{ $types[$type] }}"
        example="sales" color="{{ 'box-' . $color }}">

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
                            @if (auth()->user()->level == 1)
                                &nbsp;
                                <a href="{{ route($type . '.edit', ['sale' => $sale->id]) }}">
                                    <i class="fa fa-pencil"></i>
                                </a>
                            @endif
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