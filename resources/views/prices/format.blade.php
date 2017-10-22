<html>
<head>
    <meta charset="UTF-8">
    <title>CAP</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link href="{{ asset('/css/all.css') }}" rel="stylesheet" type="text/css" />

    <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" type="text/css" />

    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('/plugins/iCheck/all.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('/plugins/select2.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('/plugins/dataTables.bootstrap.css') }}">

    <style>
        th, td, p {
            font-size: 13px;
        },

    </style>
</head>

<body onload="window.print()">
    <div class="wrapper">
        <section class="invoice">
            <div class="row">
                <div class="col-xs-3">
                    <center>
                        <img width="160px" src="{{ asset('/img/LogoHorizontal.png') }}">
                    </center>
                </div>
                <div class="col-xs-7">
                    <h4 align="center">
                        <b>CONSORCIO <br> AVÍCOLA - PORCÍCOLA</b><br><br>
                    </h4>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-8 col-xs-offset-2">
                    <table class="table">
                        <thead>
                            <tr>
                                <th width="50%"></th>
                                <th width="50%" align="right"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Lista de precios a partir del</td>
                                <td align="right">{{ $date }}</td>
                            </tr>

                            <tr><td></td><td></td></tr>

                            @foreach ($fresh as $row)
                                <tr>
                                    <td>Fresco entero ({{ $row->name }})</td>
                                    <td align="right">{{ $row->niceprice }}</td>
                                </tr>
                            @endforeach

                            <tr><td></td><td></td></tr>

                            @foreach ($alive as $row)
                                <tr>
                                    <td>Vivo ({{ $row->name }})</td>
                                    <td align="right">{{ $row->niceprice }}</td>
                                </tr>
                            @endforeach

                            <tr><td></td><td></td></tr>

                            @foreach ($processed as $row)
                                <tr>
                                    <td>{{ $row->id < 13 ? 'Procesado' . ' (' . $row->name . ')' : $row->name }} </td>
                                    <td align="right">{{ $row->niceprice }}</td>
                                </tr>
                            @endforeach

                            <tr><td></td><td></td></tr>

                            @foreach ($pork as $row)
                                <tr>
                                    <td>Cerdo ({{ $row->name }})</td>
                                    <td align="right">{{ $row->niceprice }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </section>
    </div>
</body>
</html>
