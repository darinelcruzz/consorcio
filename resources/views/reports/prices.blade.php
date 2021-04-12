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

<body onload="window.print()">
    <section class="invoice">
        <div class="row">
            <div class="col-xs-4">
                <left>
                    <img width="160px" src="{{ asset('/img/LogoHorizontal.png') }}">
                </left>
            </div>
            <div class="col-xs-5">
                <h4 align="center">
                    <b>REPORTE DE PRECIOS</b><br>
                        {{ $range }}
                </h4>
            </div>
        </div>

        @if($type == 'ventas')

        @foreach (['cerdo' => 'pork', 'pollo vivo' => 'alive', 'pollo fresco' => 'fresh', 'procesado' => 'processed'] as $product => $prices)
            <div class="row">
                <div class="col-xs-12">
                    <table class="table" id="ordered{{ $loop->iteration}}">
                        @if($loop->iteration == 1)
                            <thead>
                                <tr>
                                    <th width="40%">Producto</th>
                                    <th class="text-center" width="20%">Cantidad</th>
                                    <th class="text-center" width="20%">Kg</th>
                                    <th class="text-center" width="20%">Precio</th>
                                </tr>
                            </thead>
                        @endif
                        @php
                        $totalQ = $totalK = 0;
                        @endphp
                        <tbody>
                            @foreach ($$prices as $price => $movements)
                                <tr>
                                    <td width="40%">{{ $loop->iteration == 1 ? strtoupper($product == 4 ? 'pollo procesado': $product): '' }}</td>
                                    <td align="center" width="20%">{{ $movements->sum('quantity') }}</td>
                                    <td align="center" width="20%">{{ number_format($movements->sum('kg'), 2) }}</td>
                                    <td align="center" width="20%">{{ number_format((float) $price, 2) }}</td>
                                </tr>
                                @php
                                $totalQ += $movements->sum('quantity');
                                $totalK += $movements->sum('kg');
                                @endphp
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th style="text-align: right;"></th>
                                <td align="center"><b>{{ $totalQ }}</b></td>
                                <td align="center"><b>{{ number_format($totalK, 2) }}</b></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        @endforeach

        @endif

        @foreach ($cuts as $product => $prices)
            <div class="row">
                <div class="col-xs-12">
                    <table class="table" id="ordered{{ $loop->iteration}}">
                        @if($type == 'compras' && $loop->iteration == 1)
                            <thead>
                                <tr>
                                    <th width="40%">Producto</th>
                                    <th class="text-center" width="20%">Cantidad</th>
                                    <th class="text-center" width="20%">Kg</th>
                                    <th class="text-center" width="20%">Precio</th>
                                </tr>
                            </thead>
                        @endif

                        @php
                        $totalQ = $totalK = 0;
                        @endphp
                        <tbody>
                            @foreach ($prices as $price => $movements)
                                <tr>
                                    <td width="40%">{{ $loop->iteration == 1 ? strtoupper($product == 4 ? 'pollo procesado': $product): '' }}</td>
                                    <td align="center" width="20%">{{ $movements->sum('quantity') }}</td>
                                    <td align="center" width="20%">{{ number_format($movements->sum('kg'), 2) }}</td>
                                    <td align="center" width="20%">{{ number_format((float) $price, 2) }}</td>
                                </tr>
                                @php
                                $totalQ += $movements->sum('quantity');
                                $totalK += $movements->sum('kg');
                                @endphp
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th style="text-align: right;"></th>
                                <td align="center"><b>{{ $totalQ }}</b></td>
                                <td align="center"><b>{{ number_format($totalK, 2) }}</b></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        @endforeach
    </section>
</body>
</html>
