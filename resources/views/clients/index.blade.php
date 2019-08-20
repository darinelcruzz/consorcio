@extends('admin')

@section('main-content')

    <data-table col="col-md-12" title="Clientes"
        example="example1" color="box-warning">

        <template slot="header">
            <tr>
                <th>ID</th>
                <th>
                    <i class="fa fa-cogs"></i>
                </th>
                <th>Nombre</th>
                <th>Dirección</th>
                <th>Productos</th>
                <th>Crédito</th>
            </tr>
        </template>

        <template slot="body">
            @foreach($clients as $client)
                <tr>
                    <td>{{ $client->id }}</td>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-xs btn-warning dropdown-toggle" data-toggle="dropdown">
                              <i class="fa fa-cogs" aria-hidden="true"></i>
                              <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                              <li>
                                  <a href="{{ route('client.show', ['id' => $client->id])}}">
                                      <i class="fa fa-eye"></i> Detalles
                                  </a>
                              </li>
                              <li>
                                <a href="{{ route('client.edit', ['id' => $client->id])}}" title="EDITAR">
                                    <i class="fa fa-pencil" aria-hidden="true"></i> Editar
                                </a>
                              </li>
                              @if(!$client->hasSales && auth()->user()->level == 1)
                              <li>
                                <a href="{{ route('client.destroy', $client )}}">
                                    <i class="fa fa-trash" aria-hidden="true"></i> Eliminar
                                </a>                                  
                              </li>
                              @endif
                            </ul>
                        </div>
                    </td>
                    <td>
                        {{ $client->name }} 
                        {{-- @if($client->isMissing)
                            <span class="pull-right"><code><i class="fa fa-exclamation"></i> sin compras recientes</code></span>
                        @endif --}}
                        <br>
                        {!! $client->email ? $client->email . '<br>' : ''  !!}
                        {!! $client->phone ? $client->phone . ' | ' : ''  !!}
                        {{ $client->cellphone or ''}}
                    </td>
                    <td>
                        {{ $client->address }} <br>
                        {{ $client->rfc }} 
                    </td>
                    <td>
                        @if ($client->products == 'N;')
                            <span class="label label-danger">Sin producto</span>
                        @else
                            @foreach (unserialize($client->products) as $product)
                                @if (!$loop->last)
                                    {{ ucfirst($product) }} |
                                @else
                                    {{ ucfirst($product) }}
                                @endif
                            @endforeach
                        @endif
                    </td>
                    <td>
                        {!! $client->credit == 1 ? $client->notes  . ' notas<br> [' . $client->days . ' días]' : 'No' !!}
                    </td>
                </tr>
            @endforeach
        </template>

    </data-table>

@endsection
