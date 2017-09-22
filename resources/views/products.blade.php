@extends('admin')

@section('main-content')

    <div class="row">
        <div class="col-md-6">
            <data-table-com title="Productos" color="box-warning">
                <template slot="header">
                    <tr>
                        <th>Nombre</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                    </tr>
                </template>

                <template slot="body">
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ $product->nice_price }}</td>
                        </tr>
                    @endforeach
                </template>
            </data-table-com>
        </div>

        <div class="col-md-6">
            <solid-box title="Agregar nuevo producto" color="box-warning">
            {!! Form::open(['method' => 'POST', 'route' => 'product.store']) !!}
                {!! Field::text('name', ['tpl' => 'templates/withicon'], ['icon' => 'pencil']) !!}
                {!! Field::number('quantity', 0, ['tpl' => 'templates/withicon', 'min' => '0'], ['icon' => 'list-ol']) !!}
                {!! Field::number('price', 0, ['tpl' => 'templates/withicon', 'step' => '0.1', 'min' => '0'], ['icon' => 'usd']) !!}
                {!! Form::checkboxes('processed', ['1' => 'Procesado']) !!}

                {!! Form::submit('Agregar', ['class' => 'btn btn-warning pull-right']) !!}
            {!! Form::close() !!}
            </solid-box>
        </div>
    </div>

@endsection
