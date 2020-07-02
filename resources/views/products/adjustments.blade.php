@extends('admin')

@section('main-content')
<div class="row">
    <div class="col-md-4">
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">Editar cantidad</h3>
            </div>
            {!! Form::open(['method' => 'POST', 'route' => 'adjustment.store']) !!}
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            {!! Field::select('product_id', $products->toArray(), null,
                                ['empty' => 'Seleccione un producto'])
                            !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            {!! Field::number('quantity', ['min' => '0']) !!}
                        </div>
                        <div class="col-md-7">
                            {!! Field::date('date', $date) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            {!! Field::text('description') !!}
                        </div>
                    </div>
                </div>

                <div class="box-footer">
                    {!! Form::submit('Modificar', ['class' => 'btn btn-warning btn-block']) !!}
                </div>
            {!! Form::close() !!}
        </div>
    </div>

    <div class="col-md-8">
        <data-table-com title="Historial de ajustes" example="example1" color="box-warning">
            <template slot="header">
                <tr>
                    <th>#</th>
                    <th>Producto</th>
                    <th>Fecha</th>
                    <th>Antes</th>
                    <th>Después</th>
                    <th>Descripción</th>
                </tr>
            </template>
            <template slot="body">
                @foreach($movements as $movement)
                    <tr>
                        <td>{{ $movement->id }}</td>
                        <td><small>{{ strtoupper($movement->product->name) }}</small></td>
                        <td>{{ date('d/m/Y', strtotime($movement->date)) }}</td>
                        <td>{{ $movement->before }}</td>
                        <td>{{ $movement->quantity }}</td>
                        <td>{{ $movement->description }}</td>
                    </tr>
                @endforeach
            </template>
        </data-table-com>
    </div>
</div>

@endsection
