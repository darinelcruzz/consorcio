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

                <label for="products"><b>Productos que compra:</b></label>
                {!! Form::checkboxes('products', ['vivo' => 'Pollo vivo', 'fresco' => 'Pollo fresco',
                    'procesado' => 'Pollo procesado', 'cerdo' => 'Cerdo',]) !!}

                {!! Form::submit('Agregar', ['class' => 'btn btn-warning pull-right']) !!}
            </row-woc>
            {!! Form::close() !!}
        </solid-box>
    </row-woc>

@endsection
