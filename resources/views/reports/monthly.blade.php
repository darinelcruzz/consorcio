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

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

    <style>
        th, td {
            font-size: 13px;
            position: relative;
        }
        h4 {
            font-size: 17px;
        }

        .bottom {
            position: absolute;
            bottom: 0
        }

    </style>
</head>

{{-- <body onload="window.print()"> --}}
<body>
    <section class="invoice">
        <div class="row">
            <div class="col-xs-4">
                <left>
                    <img width="160px" src="{{ asset('/img/LogoHorizontal.png') }}">
                </left>
            </div>
            <div class="col-xs-4">
                <h4 align="center">
                    <b>{{ $client ? $client->name: 'VENTAS'  }}</b><br>
                </h4>
            </div>
            <div class="col-xs-4">
                <h3 align="center">
                    <b>{{ ucfirst($month->format('F Y')) }}</b><br>
                </h3>
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-bordered">
                {{-- <table width="100%" border="1px solid black"> --}}
                    <thead>
                        <tr>
                            <th style="text-align: center; width: 14%">DOMINGO</th>
                            <th style="text-align: center; width: 14%">LUNES</th>
                            <th style="text-align: center; width: 14%">MARTES</th>
                            <th style="text-align: center; width: 14%">MIÉRCOLES</th>
                            <th style="text-align: center; width: 14%">JUEVES</th>
                            <th style="text-align: center; width: 14%">VIERNES</th>
                            <th style="text-align: center; width: 14%">SÁBADO</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($weeks as $row)
                            <tr>
                                @foreach([1, 2, 3, 4, 5, 6, 7] as $column)
                                    <td style="text-align: left;">
                                        @php
                                            $products = []
                                        @endphp
                                        @if(isset($sales[$month->format('Y-m') . "-" . substr("0" . ($column + $row * 7 - $offset), -2)]))
                                            @php
                                                $day = $sales[$month->format('Y-m') . "-" . substr("0" . ($column + $row * 7 - $offset), -2)];
                                                $products = ['alive' => 0, 'fresh' => 0, 'processed' => 0, 'pork' => 0];
                                                $icons = ['alive' => 'kiwi-bird', 'fresh' => 'egg', 'processed' => 'drumstick-bite', 'pork' => 'bacon'];

                                                foreach ($day as $sale) {
                                                    if ($sale instanceof App\AliveSale) {
                                                        $products['alive'] += $sale->quantity;
                                                    } else if ($sale instanceof App\FreshSale) {
                                                        $products['fresh'] += $sale->quantity;
                                                    } else if ($sale instanceof App\ProcessedSale) {
                                                        $products['processed'] += $sale->quantity;
                                                    } else if ($sale instanceof App\PorkSale) {
                                                        $products['pork'] += $sale->quantity;
                                                    }
                                                }
                                            @endphp

                                            @foreach($products as $key => $value)
                                                @if($value != 0)
                                                    <span class="pull-right">
                                                        <i class="fa fa-{{ $icons[$key] }}"></i> &nbsp; {{ $value }} 
                                                        {{ $key == 'processed' ? ' caja': ($key == 'pork' ? 'cerdo': 'pollo')}}{{ $value > 1 ? 's': '' }}
                                                    </span><br>
                                                @endif
                                            @endforeach

                                            
                                        @endif

                                        @if(array_sum($products) == 0)
                                            &nbsp;<br>
                                            &nbsp;<br>
                                        @endif

                                        <br>

                                        <small class="bottom">{{ ($column + $row * 7 - $offset) > $limit || ($column + $row * 7 - $offset) < 1 ? '': $column + $row * 7 - $offset }}</small>

                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-md-9"></div>
            <div class="col-md-3">
                <span class="pull-right">
                    <i class="fa fa-kiwi-bird"></i> &nbsp;&nbsp; VIVO
                </span><br>
                <span class="pull-right">
                    <i class="fa fa-egg"></i> &nbsp;&nbsp; FRESCO
                </span><br>
                <span class="pull-right">
                    <i class="fa fa-drumstick-bite"></i> &nbsp;&nbsp; PROCESADO
                </span><br>
                <span class="pull-right">
                    <i class="fa fa-bacon"></i> &nbsp;&nbsp; CERDO
                </span><br>
            </div>
        </div>
    </section>
</body>
</html>
