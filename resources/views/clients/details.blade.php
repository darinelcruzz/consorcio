@extends('admin')

@section('main-content')

    <row-woc col="col-md-12">
        <div class="small-box bg-green">
            <div class="inner">
                <h3>{{ $client->name }}</h3>
                <p>{{ $client->address }}</p>
                <h4 align="right">
                    Saldo:&nbsp;$0.00&nbsp;&nbsp;&nbsp;
                    Máximas:&nbsp;{{ $client->notes }}&nbsp;&nbsp;&nbsp;
                    En deuda:&nbsp;0
                </h4>
            </div>
            <div class="icon">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
            </div>
        </div>
    </row-woc>

    @includeWhen(count($client->freshsales) > 0, 'clients/sales', ['type' => 'FRESCO', 'color' => 'warning', 'sale' => 'freshsales', 'example' => '1'])
    @includeWhen(count($client->alivesales) > 0, 'clients/sales', ['type' => 'VIVO', 'color' => 'primary', 'sale' => 'alivesales', 'example' => '2'])
    @includeWhen(count($client->processedsales) > 0, 'clients/sales', ['type' => 'PROCESADO', 'color' => 'success', 'sale' => 'processedsales', 'example' => '3'])
    @includeWhen(count($client->porksales) > 0, 'clients/sales', ['type' => 'CERDO', 'color' => 'baby', 'sale' => 'porksales', 'example' => '4'])

@endsection
