@extends('admin')

@section('main-content')
<h2>Bienvenido, {{ auth()->user()->name }}</h2>
    <div align="center">
    	<img width="40%" height="40%" src="{{ asset('/img/logocap.png') }}">
    </div>
@endsection
