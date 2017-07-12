@extends('adminlte::layouts.auth')

@section('htmlheader_title')
    Log in
@endsection

@section('content')
<body class="hold-transition login-page">
    <div id="app">
        <div class="login-box">
            <div class="login-logo">
                <b>RUNA</b>
            </div>

            <div class="login-box-body">
                <p class="login-box-msg">Inicia sesión para acceder</p>


                {!! Form::open(['method' => 'POST', 'route' => 'enter']) !!}
                    {!! Field::text('user',
                        ['tpl' => 'templates/withicon'], ['icon' => 'user-circle']) !!}
                    {!! Field::password('password',
                        ['tpl' => 'templates/withicon'], ['icon' => 'key']) !!}
                    {!! Form::submit('Entrar', ['class' => 'btn btn-primary btn-block']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    @include('adminlte::layouts.partials.scripts_auth')

    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
</body>

@endsection
