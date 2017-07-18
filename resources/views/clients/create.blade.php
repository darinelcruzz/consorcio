@extends('admin')

@section('main-content')

    <row-woc col="col-md-6">
        <solid-box title="Nuevo cliente" color="box-warning" collapsed="">
            {!! Form::open(['method' => 'POST', 'route' => 'client.store']) !!}
            <row-woc col="col-md-12">
                {!! Field::text('name', ['tpl' => 'templates/withicon'], ['icon' => 'user']) !!}
                {!! Field::email('email', ['tpl' => 'templates/withicon'], ['icon' => 'at']) !!}
                {!! Field::text('address', ['tpl' => 'templates/withicon'], ['icon' => 'home']) !!}
                {!! Field::text('phone', ['tpl' => 'templates/withicon'], ['icon' => 'phone']) !!}
                {!! Field::text('cellphone', ['tpl' => 'templates/withicon'], ['icon' => 'mobile']) !!}
                {!! Field::text('rfc', ['label' => 'R.F.C.', 'tpl' => 'templates/withicon'], ['icon' => 'file-text']) !!}

                <div class="row">
                    <div class="col-md-6">
                        <label for="products"><b>Productos que compra:</b></label>
                        {!! Form::checkboxes('products', ['vivo' => 'Pollo vivo', 'fresco' => 'Pollo fresco',
                            'procesado' => 'Pollo procesado', 'cerdo' => 'Cerdo',]) !!}
                    </div>

                    <div class="col-md-6">
                        <label for="credit"><b>¿Se da crédito?</b></label><br>
                        <input type="checkbox" name="credit" value="1" v-model="checked"> Sí <br>
                        Notas: <br>
                        <input type="number" name="notes" value="1" :disabled="!checked.length">
                    </div>
                </div>

                {!! Form::submit('Agregar', ['class' => 'btn btn-warning pull-right']) !!}
            </row-woc>
            {!! Form::close() !!}
        </solid-box>
    </row-woc>

@endsection
