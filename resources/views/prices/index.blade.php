@extends('admin')

@section('main-content')
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-solid box-baby">
                        <div class="box-header">
                            <h3 class="box-title">Cerdo</h3>
                        </div>
                        <div class="box-body">
                            @foreach ($pork as $row)
                                <li>{{ $row->name }}
                                    <span class="pull-right badge bg-baby">{{ $row->nicePrice }}</span>
                                    <span class="pull-right"><code>{{ $row->getdate('updated_at') }}</code></span>
                                </li>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
            		<div class="box box-solid box-warning">
                        <div class="box-header">
                            <h3 class="box-title">Pollo fresco</h3>
                        </div>
                        <div class="box-body">
                            @foreach ($fresh as $row)
                                <li>{{ $row->name }}
                                    <span class="pull-right badge bg-yellow">{{ $row->nicePrice }}</span>
                                    <span class="pull-right"><code>{{ $row->getdate('updated_at') }}</code></span>
                                </li>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-solid box-primary">
                        <div class="box-header"><h3 class="box-title">Pollo vivo</h3></div>
                        <div class="box-body">
                            @foreach ($alive as $row)
                                <li>{{ $row->name }}
                                    <span class="pull-right badge bg-blue">{{ $row->nicePrice }}</span>
                                    <span class="pull-right"><code>{{ $row->getdate('updated_at') }}</code></span>
                                </li>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-solid box-success">
                        <div class="box-header">
                            <h3 class="box-title">Procesado</h3>
                        </div>
                        <div class="box-body">
                            @foreach ($processed as $row)
                                <li>{{ $row->name }}
                                    <span class="pull-right badge bg-green">{{ $row->nicePrice }}</span>
                                    <span class="pull-right"><code>{{ $row->getdate('updated_at') }}</code></span>
                                </li>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-warning">
                <div class="box-header">
                    <h3 class="box-title">Editar precio</h3>
                </div>
                {!! Form::open(['method' => 'POST', 'route' => 'price.update']) !!}
                    <div class="box-body">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    {!! Field::select('product', $prices->toArray(), null,
                                        ['empty' => 'Seleccione un producto'])
                                        !!}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    {!! Field::number('price') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        {!! Form::submit('Modificar', ['class' => 'btn btn-black btn-block']) !!}
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
        <row-woc col="col-md-3">
            <a href="{{ route('price.format') }}" class="btn btn-app">
                <i class="fa fa-print"></i> Imprimir
            </a>
        </row-woc>
    </div>

@endsection
