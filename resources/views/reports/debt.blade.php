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
            <div class="col-xs-8">
                <h4 align="center">
                    <big>COBRANZA {{ strtoupper($type) . ($type == 'vivo' ? ' | FRESCO': '') }}</big><br><br>
                    PARA 
                    <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>, 
                    <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>
                    {{ strtoupper($date) }}
                </h4>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                @foreach ($salesByClient as $client => $concatSales)
                    <table class="table">
                        <tbody>
                            {{-- @dd($sales->groupBy('date')) --}}
                            @foreach($concatSales->sortBy('date')->groupBy('date') as $date => $sales)
                                @if($loop->first)
                                    <thead>
                                        <tr>
                                            <th colspan="4">{{ $client }}</th>
                                        </tr>
                                        <tr>
                                            <th>Fecha</th>
                                            <th style="text-align: center;">Folio</th>
                                            <th style="text-align: right;">Importe</th>
                                            <th style="width: 60%">&nbsp;</th>
                                        </tr>
                                    </thead>
                                @endif
                                @foreach($sales->sortBy('folio') as $sale)
                                    <tr>
                                        <td>
                                            @if($loop->first)
                                                {{ date('d-m-y', strtotime($sale->date)) }}
                                            {{-- <strong>{{ date('d-m-y', strtotime($sale->date)) }}</strong> --}}
                                            @else
                                                {{-- {{ date('d-m-y', strtotime($sale->date)) }} --}}
                                            @endif
                                        </td>
                                        <td style="text-align: center;">
                                            {{ substr(str_repeat(0, 4) . $sale->folio, - 4) }}<b>{{ $sale->series }}</b>
                                            <em>{{ ['cerdo' => '', 'vivo' => 'V', 'fresco' => 'F', 'procesado' => ''][$sale->type] }}</em>
                                        </td>
                                        <td style="text-align: right;">
                                            {{ number_format($sale->amount, 2) }}
                                        </td>
                                        <td></td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                    <hr><br>
                @endforeach
            </div>
        </div>

    </section>

</body>
</html>
