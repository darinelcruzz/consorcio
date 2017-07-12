@extends('admin')

@section('main-content')

    <row-woc col="col-md-6">
        <solid-box title="Nuevo cliente" color="box-warning" collapsed="">
            {!! Form::open(['method' => 'POST', 'route' => 'client.update']) !!}
            <row-woc col="col-md-12">
                {!! Field::text('name', $client->name, ['tpl' => 'templates/withicon'], ['icon' => 'user']) !!}
                {!! Field::email('email', $client->email, ['tpl' => 'templates/withicon'], ['icon' => 'at']) !!}
                {!! Field::text('address', $client->address, ['tpl' => 'templates/withicon'], ['icon' => 'home']) !!}
                {!! Field::text('phone', $client->phone, ['tpl' => 'templates/withicon'], ['icon' => 'phone']) !!}
                {!! Field::text('cellphone', $client->cellphone, ['tpl' => 'templates/withicon'], ['icon' => 'mobile']) !!}
                {!! Field::text('rfc', $client->rfc, ['label' => 'R.F.C.', 'tpl' => 'templates/withicon'], ['icon' => 'file-text']) !!}

                <label for="products"><b>Productos que compra:</b></label>
                {!! Form::checkboxes('products', ['vivo' => 'Pollo vivo', 'fresco' => 'Pollo fresco',
                    'procesado' => 'Pollo procesado', 'cerdo' => 'Cerdo',], unserialize($client->products)) !!}

                <input type="hidden" name="id" value="{{ $client->id }}">
                {!! Form::submit('Modificar', ['class' => 'btn btn-warning pull-right']) !!}
            </row-woc>
            {!! Form::close() !!}
        </solid-box>
    </row-woc>

@endsection
