@extends('admin')

@section('main-content')

    <row-woc col="col-md-12">
        <div class="small-box bg-{{ $client->credit == 0 ? "green" : ($client->notes > $client->unpaid_notes ? "green" : ($client->notes == $client->unpaid_notes ? "yellow" : "red")) }}">
            <div class="inner">
                <h3>{{ $client->name }}</h3>
                <p>{{ $client->address }}</p>
                @if ($client->credit == 1)
                    <h4 align="right">
                        Saldo:&nbsp;{{ '$ ' . number_format($client->real_balance, 2) }}&nbsp;&nbsp;&nbsp;
                        Máximas:&nbsp;{{ $client->notes }}&nbsp;&nbsp;&nbsp;
                        En deuda:&nbsp;{{ $client->unpaid_notes }}
                    </h4>
                @endif
            </div>
            <div class="icon">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
            </div>
        </div>
    </row-woc>

    @foreach($products as $product => $color)
        @includeWhen(count($client->{$product . 'sales'}) > 0, 'clients/sales')
    @endforeach

    {{-- @includeWhen(count($client->freshsales) > 0, 'clients/sales', ['type' => 'FRESCO', 'color' => 'warning', 'sale' => 'freshsales', 'example' => '1'])
    @includeWhen(count($client->alivesales) > 0, 'clients/sales', ['type' => 'VIVO', 'color' => 'primary', 'sale' => 'alivesales', 'example' => '2'])
    @includeWhen(count($client->processedsales) > 0, 'clients/sales', ['type' => 'PROCESADO', 'color' => 'success', 'sale' => 'processedsales', 'example' => '3'])
    @includeWhen(count($client->porksales) > 0, 'clients/sales', ['type' => 'CERDO', 'color' => 'baby', 'sale' => 'porksales', 'example' => '4']) --}}

@endsection
