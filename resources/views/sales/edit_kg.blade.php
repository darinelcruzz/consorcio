@extends('admin')

@section('main-content')

    <div class="row">
        <div class="col-md-7">
            <solid-box title="Venta # {{ $processedsale->id }}" color="box-success">
              {!! Form::open(['method' => 'POST', 'route' => ['processed.storeKg', $processedsale]]) !!}

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Kilogramos</th>
                            <th>Cajas</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach (unserialize($processedsale->products) as $product)
                            <tr>
                                <td>{{ App\Product::find($product['i'])->name }}</td>
                                <td>
                                    <input type="number" name="prices[]" value="{{ $product['p'] or 0 }}" min="0" step="0.01">
                                </td>
                                <td>{{ $product['q'] }}</td>
                                <td>
                                  <input type="number" name="kgs[]" value="{{ $product['k'] or 0 }}" min="0" step="0.01">
                                </td>
                                <td>{{ $product['b'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
                <hr>

                  <input type="hidden" name="id" value="{{ $processedsale->id }}">
                  <button type="submit" class="btn btn-success pull-right"><i class="fa fa-floppy-o"></i>&nbsp;&nbsp;Guardar</button>
                {!! Form::close() !!}
            </solid-box>
        </div>
    </div>

@endsection
