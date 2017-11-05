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
                    <b>{{ $client->name }}</b><br>
                    {{ $range }}
                </h4>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <div class="col-xs-8">
                    <address>
                        <br>
                        <strong>{{ $client->address }}</strong><br>
                        <b>Tel.:</b> {{ $client->phone }}<br>
                        <b>Cel.:</b> {{ $client->cellphone }}<br>
                    </address>
                </div>
                @if ($client->credit == 1)
                    <div class="col-xs-4" align="right">
                        <br>
                        <b>Saldo:</b> ${{ number_format($client->real_balance,2) }}<br>
                        <b>Notas en deuda:</b> {{ number_format($client->unpaid_notes,0) }}<br>
                        <b>Notas máximas:</b> {{ number_format($client->notes,0) }}<br>
                    </div>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <table class="table" id="ordered">
                    <thead>
                        <tr>
                            <th class="text-center" width="15%">Fecha</th>
                            <th class="text-center" width="12%">Folio</th>
                            <th class="text-center" width="11%">Producto</th>
                            <th class="text-center" width="11%">Estado</th>
                            <th class="text-center" width="17%">Cant</th>
                            <th class="text-center" width="17%">Kg</th>
                            <th class="text-center" width="17%">Importe</th>

                        </tr>
                    </thead>
                    @php
                        $totalQ = 0;
                        $totalK = 0;
                        $totalA = 0;
                    @endphp
                    <tbody>
                        @foreach ($sales as $row)
                            <tr>
                                <td align="center">{{ $row->little_date }}</td>
                                <td align="center">{{ $row->folio }}</td>
                                <td align="center">{{ $row->type }}</td>
                                <td align="center">{{ $row->status }}</td>
                                <td align="right">{{ $row->quantity }}</td>
                                <td align="right">{{ $row->kg }}</td>
                                <td align="right">{{ $row->nice_amount }}</td>
                            </tr>
                            @php
                                $totalQ += $row->quantity;
                                $totalK += $row->kg;
                                $totalA += $row->amount;
                            @endphp
                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3"></td>
                            <td><b>Total</b></td>
                            <td align="right"><b>{{  number_format($totalQ,0) }}</b></td>
                            <td align="right"><b>{{  number_format($totalK,0) }}</b></td>
                            <td align="right"><b>${{ number_format($totalA,2) }}</b></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

    </section>

    @section('scripts')
        @include('adminlte::layouts.partials.scripts')
    @show
</body>
</html>
