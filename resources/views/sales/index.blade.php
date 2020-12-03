@extends('admin')

@section('main-content')

    @if(auth()->user()->level < 3)
        <div class="row">
            <div class="col-md-6">
                <a href="{{ route('sale.create', $type) }}" class="btn btn-app">
                    <span class="badge bg-red">+</span>
                    <i class="fa fa-shopping-cart"></i> Nueva venta
                </a>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <solid-box title="{{ ucfirst($type) }}" color="box-{{ $color }}">
                <sales-table type="{{ ucfirst($type) }}" :admin="1" route="{{ route("sale.index", $type) }}" color="{{ $color }}"></sales-table>
            </solid-box>
        </div>
    </div>


@endsection
