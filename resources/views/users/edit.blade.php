@extends('admin')

@section('main-content')

    <row-woc col="col-md-10">
        <solid-box title="Agregar usuario" color="box-warning">
            {!! Form::open(['method' => 'POST', 'route' => 'user.update', 'class' => 'form-horizontal']) !!}

                {!! Field::text('name', $user->name, ['label' => 'Nombre', 'tpl' => 'templates/oneline']) !!}
                {!! Field::text('email', $user->email, ['label' => 'Usuario', 'tpl' => 'templates/oneline']) !!}
                {!! Field::password('password', ['label' => 'Contraseña', 'tpl' => 'templates/oneline']) !!}
                {!! Field::password('password2', ['label' => 'Repetir contraseña', 'tpl' => 'templates/oneline']) !!}
                {!! Field::select('level',
                    ['1' => 'Todo', '2' => 'Administración', '3' => 'Gerencia'], $user->level,
                    ['label' => 'Jerarquía', 'template' => 'templates/oneline', 'empty' => 'Selecione nivel']) !!}
                <input type="hidden" name="id" value={{ $user->id }}>
                {!! Form::submit('Agregar', ['class' => 'btn btn-warning pull-right']) !!}
            {!! Form::close() !!}
        </solid-box>
    </row-woc>

@endsection
