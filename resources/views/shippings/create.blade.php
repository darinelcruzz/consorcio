@extends('admin')

@section('main-content')

    {!! Form::open(['method' => 'POST', 'route' => 'shipping.store']) !!}
    <div class="row">

        <div class="col-md-8">

            <solid-box title="Introduzca los datos del embarque"
                color="box-warning">
                    <div class="row">
                        <div class="col-md-6">
                            {!! Field::text('remission', ['tpl' => 'templates/withicon', 'maxlength' => '10', 'ph' => 'ejemplo: 9081726354'],
                                ['icon' => 'barcode']) !!}
                        </div>

                        <div class="col-md-6">
                            {!! Field::date('date', date('Y-m-d'), ['tpl' => 'templates/withicon'], ['icon' => 'calendar']) !!}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            {!! Field::select('provider', ['buenaventura' => 'Buenaventura', 'avimarca' => 'Avimarca', 'bachoco' => 'Bachoco', 'con marca' => 'Con Marca'], null,
                                ['tpl' => 'templates/withicon', 'empty' => 'Escoja un proveedor'],
                                ['icon' => 'truck'])
                            !!}
                        </div>
                        <div class="col-md-6">
                            {!! Field::select('product', [1 => 'No procesados', 20 => 'Rangos', 23 => 'Cortes'], null,
                                ['tpl' => 'templates/withicon', 'empty' => 'Escoja un producto', 'v-model.number' => 'shipp'],
                                ['icon' => 'cutlery'])
                            !!}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            {!! Field::text('observations', ['tpl' => 'templates/withicon'], ['icon' => 'eye']) !!}
                        </div>
                    </div>

                    <product-table model="envio"></product-table>
                    @foreach($errors->get('items') as $message)
                        <h5><code><em>NO AGREGASTE NINGÚN PRODUCTO</em></code></h5>
                    @endforeach

                    {!! Form::submit('Agregar', ['class' => 'btn btn-warning pull-right']) !!}
                
                {!! Form::close() !!}

            </solid-box>

        </div>

        <div class="col-md-4">
            <solid-box color="box-warning" title="Productos">
                <chicken-cuts :type="shipp"></chicken-cuts>
            </solid-box>
        </div>

    </div>

@endsection
