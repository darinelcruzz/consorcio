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
        @if(in_array(strtolower($product), $client->types))
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-solid box-{{ $color }}{{ $type == strtolower($product) ? '': ' collapsed-box'}}">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ $product }}</h3>
                            <div class="box-tools pull-right">
                              <button class="btn btn-box-tool" data-widget="collapse">
                                  <i class="fa fa-plus"></i>
                              </button>
                            </div>
                        </div>

                        <div class="box-body">
                            <client-sales :client="{{ $client->id }}" type="{{ $product }}" color="{{ $color }}">
                                {!! csrf_field() !!}
                            </client-sales>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach

@endsection
