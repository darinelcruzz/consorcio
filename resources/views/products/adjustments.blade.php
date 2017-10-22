@extends('admin')

@section('main-content')
<div class="row">
    <div class="col-md-12 col-lg-4">
        <div class="col-md-6 col-lg-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Editar cantidad</h3>
                </div>
                {!! Form::open(['method' => 'POST', 'route' => 'adjustment.store']) !!}
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                {!! Field::date('date', $date) !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                {!! Field::number('quantity', ['min' => '0']) !!}
                            </div>
                            <div class="col-md-6">
                                {!! Field::select('product_id', $products->toArray(), null,
                                    ['empty' => 'Seleccione un producto'])
                                !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                {!! Field::text('description') !!}
                            </div>
                        </div>
                    </div>

                    <div class="box-footer">
                        {!! Form::submit('Modificar', ['class' => 'btn btn-black btn-block']) !!}
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <div class="col-md-12 col-lg-8">
        <data-table-com title="Movimientos" example="example1" color="box-danger">
            <template slot="header">
                <tr>
                    <th>ID</th>
                    <th>Producto</th>
                    <th>Antes</th>
                    <th>Descripción</th>
                    <th>Despues</th>
                    <th>Fecha</th>
                    <th>Usuario</th>
                </tr>
            </template>
            <template slot="body">
                @foreach($movements as $row)
                    <tr>
                        <td>{{ $row->id }}</td>
                        <td>{{ $row->product->name }}</td>
                        <td>{{ $row->before }}</td>
                        <td>{{ $row->description }}</td>
                        <td>{{ $row->quantity }}</td>
                        <td>{{ $row->getdate('date') }}</td>
                        <td>{{ $row->user_id }}</td>
                    </tr>
                @endforeach
            </template>
        </data-table-com>
    </div>
</div>

@endsection
