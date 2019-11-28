@extends('admin')

@section('main-content')
    <div class="row">
        <div class="col-md-12">
            <solid-box color="box-warning">
                <clients-table color="warning" auth="{{ auth()->user()->level }}"></clients-table>
            </solid-box>
        </div>
    </div>
@endsection
