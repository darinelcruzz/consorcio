@extends('admin')

@section('main-content')
    <div class="row">
        <div class="col-md-6">

            <solid-box title="Pollo fresco" color="box-warning">
                @foreach ($fresh as $row)
                    <li>{{ $row->name }}
                        <span class="pull-right badge bg-yellow">{{ $row->nicePrice }}</span>
                        <span class="pull-right"><code>{{ $row->getdate('updated_at') }}</code></span>
                    </li>
                @endforeach
            </solid-box>

            <solid-box title="Pollo vivo" color="box-primary">
                @foreach ($alive as $row)
                    <li>{{ $row->name }}
                        <span class="pull-right badge bg-blue">{{ $row->nicePrice }}</span>
                        <span class="pull-right"><code>{{ $row->getdate('updated_at') }}</code></span>
                    </li>
                @endforeach
            </solid-box>

            <solid-box title="Pollo procesado" color="box-success">
                @foreach ($processed as $row)
                    <li>{{ $row->name }}
                        <span class="pull-right badge bg-green">{{ $row->nicePrice }}</span>
                        <span class="pull-right"><code>{{ $row->getdate('updated_at') }}</code></span>
                    </li>
                @endforeach
            </solid-box>

            <solid-box title="Cerdo" color="box-baby">
                @foreach ($pork as $row)
                    <li>{{ $row->name }}
                        <span class="pull-right badge bg-fuchsia">{{ $row->nicePrice }}</span>
                        <span class="pull-right"><code>{{ $row->getdate('updated_at') }}</code></span>
                    </li>
                @endforeach
            </solid-box>
        </div>

        <div class="col-md-6">
            @if (auth()->user()->level == 1)
                <solid-box title="Editar precio" color="box-default">
                    {!! Form::open(['method' => 'POST', 'route' => 'price.update']) !!}
                        <div id="field_product" class="form-group">
                            <label for="product" class="control-label">Producto</label>
                            <div class="controls">
                                <select class="form-control" name="product" id="product">
                                    <option value="" selected="selected">Seleccione un producto</option>
                                    <optgroup label="Cerdo">
                                    @foreach ($prices as $price)
                                        @if ($price->product_id == 1)
                                            <option value="{{ $price->id }}">{{ $price->name }}</option>
                                        @endif
                                    @endforeach
                                    </optgroup>
                                    <optgroup label="Pollo fresco">
                                    @foreach ($prices as $price)
                                        @if ($price->product_id == 2)
                                            <option value="{{ $price->id }}">{{ $price->name }}</option>
                                        @endif
                                    @endforeach
                                    </optgroup>
                                    <optgroup label="Pollo vivo">
                                    @foreach ($prices as $price)
                                        @if ($price->product_id == 3)
                                            <option value="{{ $price->id }}">{{ $price->name }}</option>
                                        @endif
                                    @endforeach
                                    </optgroup>
                                    <optgroup label="Pollo procesado">
                                    @foreach ($prices as $price)
                                        @if ($price->product_id >= 4 && $price->product_id < 18)
                                            <option value="{{ $price->id }}">{{ $price->name }}</option>
                                        @endif
                                    @endforeach
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                {!! Field::number('price', ['step' => '0.01', 'min' => '0']) !!}
                            </div>
                        </div>
                        <div class="box-footer">
                            {!! Form::submit('Modificar', ['class' => 'btn btn-black btn-block']) !!}
                        </div>
                    {!! Form::close() !!}
                </solid-box>
            @endif

            <row-woc col="col-md-3">
                <a href="{{ route('price.format') }}" class="btn btn-app">
                    <i class="fa fa-print"></i> Imprimir
                </a>
            </row-woc>
    </div>

@endsection
