@extends('admin')

@section('main-content')

    {!! Form::open(['method' => 'POST', 'route' => 'shipping.store']) !!}
    <div class="row">

        <div class="col-md-6">

            <solid-box title="Introduzca los datos del embarque"
                color="box-warning">
                    <div class="row">
                        <div class="col-md-6">
                            {!! Field::text('remission', ['tpl' => 'templates/withicon', 'maxlength' => '10'],
                                ['icon' => 'barcode']) !!}
                        </div>

                        <div class="col-md-6">
                            {!! Field::date('date', $today,['tpl' => 'templates/withicon'], ['icon' => 'calendar']) !!}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            {!! Field::select('provider', ['1' => 'Buenaventura'], '1',
                                ['tpl' => 'templates/withicon', 'empty' => 'Escoja un proveedor'],
                                ['icon' => 'truck'])
                            !!}
                        </div>
                        <div class="col-md-6">
                            {!! Field::select('product', $products->toArray(), null,
                                ['tpl' => 'templates/withicon', 'empty' => 'Escoja un producto', 'v-model' => 'shipp'],
                                ['icon' => 'cutlery'])
                            !!}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            {!! Field::number('quantity', ['tpl' => 'templates/withicon', 'min' => '0', 'step' => '0.1'],
                                ['icon' => 'list-ol']) !!}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            {!! Field::number('price', ['tpl' => 'templates/withicon', 'min' => '0', 'step' => '0.1'],
                                ['icon' => 'money']) !!}
                        </div>

                        <div class="col-md-6">
                            {!! Field::number('amount', ['tpl' => 'templates/withicon', 'min' => '0', 'step' => '0.1'],
                                ['icon' => 'usd']) !!}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            {!! Field::text('observations', ['tpl' => 'templates/withicon'], ['icon' => 'eye']) !!}
                        </div>
                    </div>

                    <template v-if="shipp != 20">
                        {!! Form::submit('Agregar', ['class' => 'btn btn-warning pull-right']) !!}
                    </template>

            </solid-box>

        </div>

        <div v-if="shipp == 20" class="col-md-6">
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
                        @foreach ($processed as $product)
                            <tr>
                                <td>
                                    <input type="hidden" name="pproducts[]" value="{{ $product->id }}">
                                    {{ $product->name}}
                                </td>
                                <td>
                                    {!! Field::number('quantities[]', 0, ['tpl' => 'templates/nolabel', 'min' => '0', 'step' => '0.01']) !!}
                                </td>
                                <td>
                                    {!! Field::number('prices[]', 0, ['tpl' => 'templates/nolabel', 'min' => '0', 'step' => '0.01']) !!}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {!! Form::submit('Agregar', ['class' => 'btn btn-warning pull-right']) !!}
            </solid-box>
        </div>

    </div>
    {!! Form::close() !!}

@endsection
