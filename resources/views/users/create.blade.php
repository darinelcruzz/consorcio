@extends('admin')

@section('main-content')

    <row-woc col="col-md-10">
        <solid-box title="Agregar usuario" color="box-warning">
            {!! Form::open(['method' => 'POST', 'route' => 'user.store', 'class' => 'form-horizontal']) !!}
                {!! Field::text('name', ['label' => 'Nombre', 'tpl' => 'templates/oneline']) !!}
                {!! Field::text('email', ['label' => 'Usuario', 'tpl' => 'templates/oneline']) !!}
                {!! Field::password('password', ['label' => 'Contraseña', 'tpl' => 'templates/oneline']) !!}
                {!! Field::password('password2', ['label' => 'Repetir contraseña', 'tpl' => 'templates/oneline']) !!}
                {!! Field::select('level',
                    ['1' => 'Todo', '2' => 'Administración', '3' => 'Gerencia'],
                    ['label' => 'Jerarquía', 'template' => 'templates/oneline', 'empty' => 'Selecione nivel']) !!}
                <input type="hidden" name="user" value="2">
                {!! Form::submit('Agregar', ['class' => 'btn btn-warning pull-right']) !!}
            {!! Form::close() !!}
        </solid-box>
    </row-woc>

@endsection
