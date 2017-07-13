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

@endsection
