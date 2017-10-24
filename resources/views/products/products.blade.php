@extends('admin')

@section('main-content')

    <div class="row">
        <div class="col-md-4 col-md-offset-2">
            <div class="box box-widget widget-user-2">
                <div class="widget-user-header bg-green">
                    <h3>Pollo Procesado</h3>
                </div>
                <div class="box-footer no-padding">
                    <ul class="nav nav-stacked">
                        @foreach ($processed as $product)
                            <li><a href="#">{{ $product->name }}<span class="pull-right badge bg-green">{{ $product->quantity }}</span></a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-widget widget-user-2">
                        <div class="widget-user-header bg-baby">
                            <h3>Cerdo</h3>
                        </div>
                        <div class="box-footer no-padding">
                            <ul class="nav nav-stacked">
                                @foreach ($pork as $product)
                                    <li><a href="#">{{ $product->name }}<span class="pull-right badge bg-maroon">{{ $product->quantity }}</span></a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-widget widget-user-2">
                        <div class="widget-user-header bg-primary">
                            <h3>Pollo vivo</h3>
                        </div>
                        <div class="box-footer no-padding">
                            <ul class="nav nav-stacked">
                                @foreach ($alive as $product)
                                    <li><a href="#">{{ $product->name }}<span class="pull-right badge bg-blue">{{ $product->quantity }}</span></a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-widget widget-user-2">
                        <div class="widget-user-header bg-purple">
                            <h3>Alimento</h3>
                        </div>
                        <div class="box-footer no-padding">
                            <ul class="nav nav-stacked">
                                @foreach ($food as $product)
                                    <li><a href="#">{{ $product->name }}<span class="pull-right badge bg-purple">{{ $product->quantity }}</span></a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
