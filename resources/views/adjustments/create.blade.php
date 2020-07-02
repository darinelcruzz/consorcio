@extends('admin')

@section('main-content')
<div class="row">
    <div class="col-md-12 col-lg-4">
        <div class="col-md-6 col-lg-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Agregar mortalidad</h3>
                </div>
                {!! Form::open(['method' => 'POST', 'route' => 'adjustment.store']) !!}
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <p>
                                    Cantidad de pollos vivos: {{ $count }}
                                </p>
                                {!! Field::date('date', $date) !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                {!! Field::number('quantity', ['min' => '0']) !!}
                                <input type="hidden" name="product_id" value="3">
                                <input type="hidden" name="description" value="mortalidad">
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                            </div>
                        </div>
                    </div>

                    <div class="box-footer">
                        {!! Form::submit('AGREGAR', ['class' => 'btn btn-primary btn-block']) !!}
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <div class="col-md-12 col-lg-8">
        <data-table-com title="Ajustes por mortalidad" example="example1" color="box-primary">
            <template slot="header">
                <tr>
                    <th>#</th>
                    <th>Fecha</th>
                    <th>Antes</th>
                    <th>Bajas</th>
                    <th>Después</th>
                </tr>
            </template>
            <template slot="body">
                @foreach($movements as $movement)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ date('d/m/Y', strtotime($movement->date)) }}</td>
                        <td>{{ $movement->before }}</td>
                        <td>{{ $movement->quantity }}</td>
                        <td>{{ $movement->before - $movement->quantity }}</td>
                    </tr>
                @endforeach
            </template>
        </data-table-com>
    </div>
</div>

@endsection
