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
                    <b>{{ $product }}</b><br>
                        {{ $range }}
                </h4>
            </div>
        </div>

        @foreach ($data as $name => $var)
            <h4 align="center">
                <b>{{ $name }}</b>
            </h4>
            <div class="row">
                <div class="col-xs-12">
                    <table class="table" id="ordered{{ $loop->iteration}}">
                        <thead>
                            <tr>
                                <th class="text-center" width="35%" >Cliente</th>
                                <th class="text-center" width="29%">Ubicación</th>
                                <th class="text-center" width="12%">Cantidad</th>
                                <th class="text-center" width="12%">Kg</th>
                                <th class="text-center" width="12%">Importe</th>
                            </tr>
                        </thead>
                        @php
                            $totalQ = 0;
                            $totalK = 0;
                            $totalA = 0;
                        @endphp
                        <tbody>
                            @foreach ($var->toArray() as $client_id => $kaq)
                                <tr>
                                    <td>{{ App\Client::find($client_id)->name }}</td>
                                    <td>{{ App\Client::find($client_id)->address }}</td>
                                    <td align="right">{{ collect($kaq)->sum('quantity') }}</td>
                                    <td align="right">{{ collect($kaq)->sum('kg') }}</td>
                                    <td align="right">$ {{ number_format(collect($kaq)->sum('amount'), 2) }}</td>
                                </tr>
                                @php
                                    $totalQ += collect($kaq)->sum('quantity');
                                    $totalK += collect($kaq)->sum('kg');
                                    $totalA += collect($kaq)->sum('amount');
                                @endphp
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td></td>
                                <td><b>Total</b></td>
                                <td align="right"><b>{{ $totalQ }}</b></td>
                                <td align="right"><b>{{ $totalK }}</b></td>
                                <td align="right"><b>$ {{ number_format($totalA, 2) }}</b></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        @endforeach

    </section>

    @section('scripts')
        @include('adminlte::layouts.partials.scripts')
    @show
</body>
</html>
