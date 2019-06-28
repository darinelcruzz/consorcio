@extends('admin')

@section('main-content')

    <div class="row">
        <div class="col-md-6">
            <solid-box title="Cambiar productos de la venta {{ $processedsale->folio }}" color="box-success">
                {!! Form::open(['method' => 'POST', 'route' => ['processed.storeProducts', $processedsale]]) !!}

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Kilogramos</th>
                                <th>Cajas</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach (unserialize($processedsale->products) as $product)
                                <tr>
                                    <td>
                                        {!! Field::select('products[]', $productsArray, $product['i'], 
                                            ['tpl' => 'templates/nolabel', 'empty' => 'Elija producto']) 
                                        !!}
                                    </td>
                                    <td>{{ $product['q'] }}</td>
                                    <td>{{ $product['k'] }}</td>
                                    <td>{{ $product['b'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                    <hr>

                  {!! Form::submit('GUARDAR CAMBIOS', ['class' => 'btn btn-success btn-block']) !!}

                {!! Form::close() !!}
            </solid-box>
        </div>
    </div>

@endsection