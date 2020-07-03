@extends('admin')

@section('main-content')

    {!! Form::open(['method' => 'POST', 'route' => ['shipping.update', $shipping]]) !!}
    <div class="row">

        <div class="col-md-6">

            <solid-box title="Modificar los datos del embarque"
                color="box-warning">
                    <div class="row">
                        <div class="col-md-6">
                            {!! Field::text('remission', $shipping->remission, ['tpl' => 'templates/withicon', 'maxlength' => '10'],
                                ['icon' => 'barcode']) !!}
                        </div>

                        <div class="col-md-6">
                            {!! Field::date('date', $shipping->date, ['tpl' => 'templates/withicon'], ['icon' => 'calendar']) !!}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            {!! Field::select('provider', ['buenaventura' => 'Buenaventura', 'avimarca' => 'Avimarca', 'bachoco' => 'Bachoco'], $shipping->provider,
                                ['tpl' => 'templates/withicon', 'empty' => 'Escoja un proveedor'],
                                ['icon' => 'truck'])
                            !!}
                        </div>
                        <div class="col-md-6">
                            {!! Field::select('product', $products->toArray(), $shipping->product,
                                ['tpl' => 'templates/withicon', 'empty' => 'Escoja un producto', 'disabled' => 'true'],
                                ['icon' => 'cutlery'])
                            !!}

                            <input type="hidden" name="product" value="{{ $shipping->product }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            {!! Field::number('quantity', $shipping->quantity, ['tpl' => 'templates/withicon', 'min' => '0', 'step' => '0.01'],
                                ['icon' => 'list-ol']) !!}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            {!! Field::number('price', $shipping->price, ['tpl' => 'templates/withicon', 'min' => '0', 'step' => '0.01'],
                                ['icon' => 'money']) !!}
                        </div>

                        <div class="col-md-6">
                            {!! Field::number('amount', $shipping->amount, ['tpl' => 'templates/withicon', 'min' => '0', 'step' => '0.01'],
                                ['icon' => 'usd']) !!}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            {!! Field::text('observations', $shipping->observations, ['tpl' => 'templates/withicon'], ['icon' => 'eye']) !!}
                        </div>
                    </div>

                    @if($shipping->product != '20')
                        {!! Form::submit('Agregar', ['class' => 'btn btn-warning pull-right']) !!}
                    @endif

            </solid-box>

        </div>

        @if($shipping->product == '20')
        <div class="col-md-6">
            <solid-box title="Procesado" color="box-warning">
                <table id="example6" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cajas</th>
                            <th>Precio</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (unserialize($shipping->processed) as $product)
                            <tr>
                                <td>
                                    <input type="hidden" name="pproducts[]" value="{{ $product['i'] }}">
                                    {{ App\Product::find($product['i'])->name }}
                                </td>
                                <td>
                                    {!! Field::number('quantities[]', $product['q'], ['tpl' => 'templates/nolabel', 'min' => '0', 'step' => '0.01']) !!}
                                </td>
                                <td>
                                    {!! Field::number('prices[]', $product['p'], ['tpl' => 'templates/nolabel', 'min' => '0', 'step' => '0.01']) !!}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {!! Form::submit('Agregar', ['class' => 'btn btn-warning pull-right']) !!}
            </solid-box>
        </div>
        @endif
    </div>
    {!! Form::close() !!}

@endsection
