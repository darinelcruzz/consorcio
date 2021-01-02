@extends('admin')

@section('main-content')

    <div class="row">
        <div class="col-md-6">
            <a href="{{ route('shipping.create') }}" class="btn btn-app">
                <span class="badge bg-red">+</span>
                <i class="fa fa-truck"></i> AGREGAR
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <solid-box color="box-warning" title="Embarques">
                <shippings-table></shippings-table>                
            </solid-box>
        </div>
    </div>

@endsection
