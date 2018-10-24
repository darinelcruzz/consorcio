@extends('admin')

@section('main-content')

    <div class="row">
        <div class="col-md-6">
            <a href="{{ route($type . '.create') }}" class="btn btn-app">
                <span class="badge bg-red">+</span>
                <i class="fa fa-shopping-cart"></i> Nueva venta
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <solid-box title="{{ $types[$type] }}" color="{{ 'box-' . $color }}">
                <sales-table type="{{ $types[$type] }}" :admin="1" route="{{ route("$type.index") }}" color="{{ $color }}"></sales-table>
            </solid-box>
        </div>
    </div>


@endsection
