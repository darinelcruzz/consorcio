<html>
<head>
    <meta charset="UTF-8">
    <title>Reporte | Compras</title>
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

    <link rel="icon" href="{{ asset('/img/Logo.ico') }}" />

    <style>
        th, td, p, address, h5 {
            font-size: 13px;
        }
        h4 {
            font-size: 17px;
        }

    </style>
</head>

<body>
    <section class="invoice">
        <div class="row">
            <div class="col-xs-4">
                <left>
                    <img width="160px" src="{{ asset('/img/LogoHorizontal.png') }}">
                </left>
            </div>
            <div class="col-xs-5">
                <h4 align="center">
                    <b>Compras de {{ ucfirst($month) }}</b><br>
                        {{ $year }}
                </h4>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <table class="table" id="ordered1">
                    <thead>
                        <tr>
                            <th width="35%" >Producto</th>
                            <th style="text-align: right" width="12%">Cantidad</th>
                            <th style="text-align: right" width="12%">Kg</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($data as $product => $movements)
                            <tr>
                                <td>{{ $product }}</td>
                                <td align="right">{{ number_format($movements->sum('quantity')) }}</td>
                                <td align="right">{{ number_format($movements->sum('kg')) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</body>
</html>
