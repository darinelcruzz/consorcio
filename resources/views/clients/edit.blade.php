@extends('admin')

@section('main-content')

    <row-woc col="col-md-6">
        <solid-box title="Nuevo cliente" color="box-warning" collapsed="">
            {!! Form::open(['method' => 'POST', 'route' => 'client.update']) !!}
            <row-woc col="col-md-12">
                {!! Field::text('name', $client->name, ['tpl' => 'templates/withicon'], ['icon' => 'user']) !!}
                {!! Field::email('email', $client->email, ['tpl' => 'templates/withicon'], ['icon' => 'at']) !!}
                {!! Field::text('address', $client->address, ['tpl' => 'templates/withicon'], ['icon' => 'home']) !!}
                {!! Field::text('phone', $client->phone, ['tpl' => 'templates/withicon'], ['icon' => 'phone']) !!}
                {!! Field::text('cellphone', $client->cellphone, ['tpl' => 'templates/withicon'], ['icon' => 'mobile']) !!}
                {!! Field::text('rfc', $client->rfc, ['label' => 'R.F.C.', 'tpl' => 'templates/withicon'], ['icon' => 'file-text']) !!}

                <div class="row">
                    <div class="col-md-6">
                        <label for="products"><b>Productos que compra:</b></label>
                        {!! Form::checkboxes('products', ['vivo' => 'Pollo vivo', 'fresco' => 'Pollo fresco',
                            'procesado' => 'Pollo procesado', 'cerdo' => 'Cerdo',], unserialize($client->products)) !!}
                    </div>

                    @if ($client->credit)
                        <div class="col-md-6">
                            <label for="credit"><b>¿Se da crédito?</b></label><br>
                            <input type="checkbox" name="credit" value="1" checked> Sí <br>
                            Notas: <br>
                            <input type="number" name="notes" value="{{ $client->notes }}">
                            <br>Días:<br>
                            <input type="number" name="days" value="{{ $client->days }}">
                        </div>
                    @else
                        <div class="col-md-6">
                            <label for="credit"><b>¿Se da crédito?</b></label><br>
                            <input type="checkbox" name="credit" value="1" v-model="checked"> Sí <br>
                            Notas: <br>
                            <input type="number" name="notes" :disabled="!checked.length">
                            <br>Días: <br>
                            <input type="number" name="days" :disabled="!checked.length">
                        </div>
                    @endif
                </div>

                <input type="hidden" name="id" value="{{ $client->id }}">
                {!! Form::submit('Modificar', ['class' => 'btn btn-warning pull-right']) !!}
            </row-woc>
            {!! Form::close() !!}
        </solid-box>
    </row-woc>

@endsection
